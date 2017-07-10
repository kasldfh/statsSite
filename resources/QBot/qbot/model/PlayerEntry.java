package qbot.model;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;
import java.util.Map.Entry;

public class PlayerEntry {
	private String realName = "";

	private String playername = "";
	private String team = "";
	private String hp_time = "";
	private int hp_time_rank = 0;
	private String hp_defends = "";
	private int hp_defends_rank = 0;
	private double snd_plants = 0;
	private int snd_plants_rank = 0;
	private double snd_defuses = 0;
	private int snd_defuses_rank = 0;
	private double up_pts = 0;
	private int up_pts_rank = 0;
	private double event_kd = 0;
	private int event_kd_rank = 0;
	private double event_snd_kd = 0;
	private int event_snd_kd_rank = 0;
	private double event_hp_kd = 0;
	private int event_hp_kd_rank = 0;
	private double event_up_kd = 0;
	private int event_up_kd_rank = 0;
	private Map<String, Integer> teamCount;

	public int getHp_time_rank() {
		return hp_time_rank;
	}
	
	public void addTeamToList(String s){
		teamCount.putIfAbsent(s, 0);
		teamCount.put(s, teamCount.get(s).intValue() + 1);
	}
	
	public String getMostLikelyTeam(){
		int max = 0;
		String team = "";
		for(String s : teamCount.keySet()){
			if(max == 0 || max < teamCount.get(s)){
				max = teamCount.get(s);
				team = s;
			}
		}
		return team;
	}

	public String getTeam() {
		return team;
	}

	public String getRealName() {
		return realName;
	}
	
	public void setRealName(String realName) {
		this.realName = realName;
	}


	public void setTeam(String team) {
		this.team = team;
	}



	public void setHp_time_rank(int hp_time_rank) {
		this.hp_time_rank = hp_time_rank;
	}

	public int getHp_defends_rank() {
		return hp_defends_rank;
	}

	public void setHp_defends_rank(int hp_defends_rank) {
		this.hp_defends_rank = hp_defends_rank;
	}

	public int getSnd_plants_rank() {
		return snd_plants_rank;
	}

	public void setSnd_plants_rank(int snd_plants_rank) {
		this.snd_plants_rank = snd_plants_rank;
	}

	public int getSnd_defuses_rank() {
		return snd_defuses_rank;
	}

	public void setSnd_defuses_rank(int snd_defuses_rank) {
		this.snd_defuses_rank = snd_defuses_rank;
	}

	public int getUp_pts_rank() {
		return up_pts_rank;
	}

	public void setUp_pts_rank(int up_pts_rank) {
		this.up_pts_rank = up_pts_rank;
	}

	public double getEvent_kd() {
		return event_kd;
	}

	public void setEvent_kd(double event_kd) {
		this.event_kd = event_kd;
	}

	public int getEvent_kd_rank() {
		return event_kd_rank;
	}

	public void setEvent_kd_rank(int event_kd_rank) {
		this.event_kd_rank = event_kd_rank;
	}

	public double getEvent_snd_kd() {
		return event_snd_kd;
	}

	public void setEvent_snd_kd(double event_snd_kd) {
		this.event_snd_kd = event_snd_kd;
	}

	public int getEvent_snd_kd_rank() {
		return event_snd_kd_rank;
	}

	public void setEvent_snd_kd_rank(int event_snd_kd_rank) {
		this.event_snd_kd_rank = event_snd_kd_rank;
	}

	public double getEvent_hp_kd() {
		return event_hp_kd;
	}

	public void setEvent_hp_kd(double event_hp_kd) {
		this.event_hp_kd = event_hp_kd;
	}

	public int getEvent_hp_kd_rank() {
		return event_hp_kd_rank;
	}

	public void setEvent_hp_kd_rank(int event_hp_kd_rank) {
		this.event_hp_kd_rank = event_hp_kd_rank;
	}

	public double getEvent_up_kd() {
		return event_up_kd;
	}

	public void setEvent_up_kd(double event_up_kd) {
		this.event_up_kd = event_up_kd;
	}

	public int getEvent_up_kd_rank() {
		return event_up_kd_rank;
	}

	public void setEvent_up_kd_rank(int event_up_kd_rank) {
		this.event_up_kd_rank = event_up_kd_rank;
	}

	public PlayerEntry() {
		this.teamCount = new HashMap<>();
	}

	public String getPlayername() {
		return playername;
	}

	public void setPlayername(String playername) {
		this.playername = playername;
	}

	public String getHp_time() {
		return hp_time;
	}

	public int getHPTime() {
		return Integer.parseInt(hp_time.replace("s", ""));
	}

	public void setHp_time(String hp_time) {
		this.hp_time = hp_time;
	}

	public String getHp_defends() {
		return hp_defends;
	}

	public void setHp_defends(String hp_defends) {
		this.hp_defends = hp_defends;
	}

	public double getSnd_plants() {
		return snd_plants;
	}

	public void setSnd_plants(double snd_plants) {
		this.snd_plants = snd_plants;
	}

	public double getSnd_defuses() {
		return snd_defuses;
	}

	public void setSnd_defuses(double snd_defuses) {
		this.snd_defuses = snd_defuses;
	}

	public double getUp_pts() {
		return up_pts;
	}

	public void setUp_pts(double up_pts) {
		this.up_pts = up_pts;
	}

}
