package qbot.model;

import java.util.Arrays;
import java.util.List;

public class MatchEntry implements Comparable<MatchEntry>{
	private String ID;
	private String player;
	private String map;
	private int kills;
	private int deaths;
	private String gametype;
	private boolean won;
	private String winner;
	private String loser;
	
	public MatchEntry(String iD, String player, String map, int kills, int deaths, String gametype, boolean won, String winner, String loser) {
		ID = iD;
		this.player = player;
		this.map = map;
		this.kills = kills;
		this.deaths = deaths;
		this.gametype = gametype;
		this.won = won;
		this.winner = winner;
		this.loser = loser;
	}
	
	public String getMap() {
		return map;
	}
	public void setMap(String map) {
		this.map = map;
	}
	public String getWinner() {
		return winner;
	}
	public void setWinner(String winner) {
		this.winner = winner;
	}
	public String getLoser() {
		return loser;
	}
	public void setLoser(String loser) {
		this.loser = loser;
	}
	public String getID() {
		return ID;
	}
	public void setID(String iD) {
		ID = iD;
	}
	public String getPlayer() {
		return player;
	}
	public void setPlayer(String player) {
		this.player = player;
	}
	public int getKills() {
		return kills;
	}
	public void setKills(int kills) {
		this.kills = kills;
	}
	public int getDeaths() {
		return deaths;
	}
	public void setDeaths(int deaths) {
		this.deaths = deaths;
	}
	public String getGametype() {
		return gametype;
	}
	public void setGametype(String gametype) {
		this.gametype = gametype;
	}
	public boolean isWon() {
		return won;
	}
	public void setWon(boolean won) {
		this.won = won;
	}
	@Override
	public int compareTo(MatchEntry o) {
		if(Integer.parseInt(this.getID()) > Integer.parseInt(o.getID())){
			return 1;
		}
		else if(Integer.parseInt(this.getID()) < Integer.parseInt(o.getID())){
			return 1;
		}
		return 0;
	}
	
 
	
	
	
	
	
	
}
