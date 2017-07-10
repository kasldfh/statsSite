package qbot.controller;

import java.io.File;
import java.net.URL;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;
import java.util.Map;

import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;

import qbot.model.MatchEntry;
import qbot.model.PlayerEntry;

public class StatsHelper {
	private final static String MLG_STATS_URL = "http://cod.majorleaguegaming.com/stats/player/all";
	private List<MatchEntry> matchEntries;
	private List<PlayerEntry> playerEntries;
	private List<String> teams;
	private Map<Integer, PlayerEntry> hptime;
	private Map<Integer, PlayerEntry> hpdefends;
	private Map<Integer, PlayerEntry> uppoints;
	private Map<Integer, PlayerEntry> sndplants;
	private Map<Integer, PlayerEntry> snddef;
	private Map<String, List<PlayerEntry>> teamPlayerEntries;
	String exception = "";

	public List<PlayerEntry> getTeamPlayerEntries(String s) {
		return teamPlayerEntries.get(s);
	}
	public String getException(){
		return exception;
	}
	public Map<String, List<PlayerEntry>> getTeamPlayerEntries() {
		return teamPlayerEntries;
	}

	public List<MatchEntry> getMatchEntries() {
		return matchEntries;
	}

	public List<PlayerEntry> getPlayerEntries() {
		return playerEntries;
	}

	public List<String> getTeams() {
		return teams;
	}

	public StatsHelper() {
		this.matchEntries = getMatchEntries();
		this.playerEntries = getPlayerEntries();
		this.teams = getTeams();
		hptime = new HashMap<Integer, PlayerEntry>();
		hpdefends = new HashMap<Integer, PlayerEntry>();
		uppoints = new HashMap<Integer, PlayerEntry>();
		sndplants = new HashMap<Integer, PlayerEntry>();
		snddef = new HashMap<Integer, PlayerEntry>();
		update();
	}

	public void update() {
		matchEntries = new ArrayList<>();
		playerEntries = new ArrayList<>();
		teamPlayerEntries = new HashMap();
		try {
			URL url = new URL(MLG_STATS_URL);
			try {
				// File f = new File(NEW_FILE.replace("{DATE}", ""));
				// FileUtils.copyURLToFile(url, f)
			} catch (Exception e) {

			}

			ObjectMapper mapper = new ObjectMapper();
			JsonNode rootNode = mapper.readValue(url, JsonNode.class);
			File f = new File("D:/qbot/s21.json");
			if(!f.exists()){
				try{
				f = new File("C:/Users/PeriCo/Desktop/all.json");}
				catch(Exception ex){
					exception = ex.getMessage();
					exception += "\n" + f.exists() + "\n" + f.getAbsolutePath();
				}
			}
			if(rootNode.size() == 0){
			 rootNode = mapper.readTree(f);}
			Iterator<String> sss = rootNode.fieldNames();
			while (sss.hasNext()) {
				String playername = sss.next();
				JsonNode info = rootNode.get(playername);
				PlayerEntry pe = new PlayerEntry();
				try {
					pe.setRealName(info.get("name").asText());
				} catch (Exception e) {

				}
				try {
					JsonNode event_kd = info.get("event_kd");
					pe.setEvent_kd(event_kd.get("value").asDouble());
					pe.setEvent_kd_rank(event_kd.get("rank").asInt());
				} catch (Exception e) {

				}
				try {
					JsonNode hp_kd = info.get("event_hp_kd");
					pe.setEvent_hp_kd(hp_kd.get("value").asDouble());
					pe.setEvent_hp_kd_rank(hp_kd.get("rank").asInt());
				} catch (Exception e) {

				}
				try {
					JsonNode hp_time = info.get("event_hp_time");
					pe.setHp_time(hp_time.get("value").asText());
					pe.setHp_time_rank(hp_time.get("rank").asInt());
				} catch (Exception e) {

				}
				try {
					JsonNode hp_info = info.get("event_hp_defends");
					pe.setHp_defends(hp_info.get("value").asText());
					pe.setHp_defends_rank(hp_info.get("rank").asInt());
				} catch (Exception e) {

				}
				try {
					JsonNode event_snd_kd = info.get("event_snd_kd");
					pe.setEvent_snd_kd(event_snd_kd.get("value").asDouble());
					pe.setEvent_snd_kd_rank(event_snd_kd.get("rank").asInt());
				} catch (Exception e) {

				}
				try {
					JsonNode event_up_kd = info.get("event_up_kd");
					pe.setEvent_up_kd(event_up_kd.get("value").asDouble());
					pe.setEvent_up_kd_rank(event_up_kd.get("rank").asInt());
				} catch (Exception e) {

				}
				try {
					JsonNode snd_plants = info.get("event_snd_plants");
					pe.setSnd_plants(snd_plants.get("value").asDouble());
					pe.setSnd_plants_rank(snd_plants.get("rank").asInt());
				} catch (Exception e) {

				}
				try {
					JsonNode snd_defuses = info.get("event_snd_defuses");
					pe.setSnd_defuses(snd_defuses.get("value").asDouble());
					pe.setSnd_defuses_rank(snd_defuses.get("rank").asInt());
				} catch (Exception e) {

				}
				try {
					JsonNode up_pts = info.get("event_up_pts");
					pe.setUp_pts(up_pts.get("value").asDouble());
					pe.setUp_pts_rank(up_pts.get("rank").asInt());
				} catch (Exception e) {

				}

				JsonNode details = info.get("history");
				for (JsonNode detail : details) {
					matchEntries.add(new MatchEntry(detail.get("map_id").asText(), detail.get("player").asText(),
							detail.get("map").asText(), detail.get("kills").asInt(), detail.get("deaths").asInt(),
							detail.get("gametype").asText(), detail.get("won").asBoolean(),
							detail.get("winner").asText(), detail.get("loser").asText()));
					pe.addTeamToList(detail.get("winner").asText());
					pe.addTeamToList(detail.get("loser").asText());
				}
				pe.setPlayername(playername);
				playerEntries.add(pe);
				addToTeam(pe);
			}
		} catch (Exception e) {
			System.err.println("ERROR: " + e.getMessage());
		}
		matchEntries.sort(null);
		updateTeams();
		updateStats();
	}

	private void addToTeam(PlayerEntry pe) {
		String team = pe.getMostLikelyTeam();
		teamPlayerEntries.putIfAbsent(team, new ArrayList<>());
		teamPlayerEntries.get(team).add(pe);
	}

	private void updateStats() {
		hptime.clear();
		hpdefends.clear();
		uppoints.clear();
		sndplants.clear();
		snddef.clear();
		for (PlayerEntry pe : playerEntries) {
			hptime.put(pe.getHp_time_rank(), pe);
			hpdefends.put(pe.getHp_defends_rank(), pe);
			uppoints.put(pe.getUp_pts_rank(), pe);
			sndplants.put(pe.getSnd_plants_rank(), pe);
			snddef.put(pe.getSnd_defuses_rank(), pe);
		}
	}

	public List<String> getMatchDetailsDiscord(String team1, String team2) {
		List<String> output = new ArrayList<>();
		Map<String, List<MatchEntry>> results = new HashMap<String, List<MatchEntry>>();
		for (MatchEntry m : matchEntries) {
			if ((m.getWinner().toLowerCase().equals(team1) || m.getWinner().toLowerCase().equals(team2))
					&& (m.getLoser().toLowerCase().equals(team1) || m.getLoser().toLowerCase().equals(team2))) {
				if (!results.containsKey(m.getID())) {
					List<MatchEntry> temp = new ArrayList<>();
					temp.add(m);
					results.put(m.getID(), temp);
				} else {
					results.get(m.getID()).add(m);
				}
			}
		}
		List<String> done = new ArrayList<>();
		for (Map.Entry<String, List<MatchEntry>> entry : results.entrySet()) {
			String matchString = "";
			String winner = "";
			String loser = "";
			for (MatchEntry m : entry.getValue()) {
				if (!done.contains(entry.getKey())) {
					// header
					matchString += m.getGametype() + " " + m.getMap() + " won by: " + m.getWinner() + "\n```Markdown\n";
					winner += m.getWinner() + ", Kills, Deaths\n";
					loser += m.getLoser() + ", Kills, Deaths\n";
				}
				done.add(entry.getKey());

				if (m.isWon()) {
					winner += m.getPlayer() + ", " + m.getKills() + ", " + m.getDeaths() + "\n";
				} else {
					loser += m.getPlayer() + ", " + m.getKills() + ", " + m.getDeaths() + "\n";
				}
			}
			matchString += winner + loser + "```";
			output.add(matchString);
		}
		return output;
	}

	public PlayerEntry getPlayer(String playername) {
		for (PlayerEntry pe : playerEntries) {
			if (pe.getPlayername().equalsIgnoreCase(playername)) {
				return pe;
			}
		}
		return null;
	}

	public List<String> getMatchDetails(String team1, String team2) {
		List<String> output = new ArrayList<>();
		Map<String, List<MatchEntry>> results = new HashMap<String, List<MatchEntry>>();
		for (MatchEntry m : matchEntries) {
			if ((m.getWinner().toLowerCase().equals(team1) || m.getWinner().toLowerCase().equals(team2))
					&& (m.getLoser().toLowerCase().equals(team1) || m.getLoser().toLowerCase().equals(team2))) {
				if (!results.containsKey(m.getID())) {
					List<MatchEntry> temp = new ArrayList<>();
					temp.add(m);
					results.put(m.getID(), temp);
				} else {
					results.get(m.getID()).add(m);
				}
			}
		}
		List<String> done = new ArrayList<>();
		for (Map.Entry<String, List<MatchEntry>> entry : results.entrySet()) {
			String matchString = "";
			String winner = "";
			String loser = "";
			for (MatchEntry m : entry.getValue()) {
				if (!done.contains(entry.getKey())) {
					// header
					matchString += m.getGametype() + " " + m.getMap() + " won by: " + m.getWinner() + "\n";
					winner += m.getWinner() + ", Kills, Deaths\n";
					loser += m.getLoser() + ", Kills, Deaths\n";
				}
				done.add(entry.getKey());

				if (m.isWon()) {
					winner += m.getPlayer() + ", " + m.getKills() + ", " + m.getDeaths() + "\n";
				} else {
					loser += m.getPlayer() + ", " + m.getKills() + ", " + m.getDeaths() + "\n";
				}
			}
			matchString += winner + loser + "\n\n";
			output.add(matchString);
		}
		return output;
	}

	public List<String> updateTeams() {
		teams = new ArrayList<>();
		for (MatchEntry m : matchEntries) {
			if (!teams.contains(m.getWinner())) {
				teams.add(m.getWinner());
			}
			if (!teams.contains(m.getLoser())) {
				teams.add(m.getLoser());
			}
		}
		return teams;
	}
}