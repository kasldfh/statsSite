package qbot.view;

import java.awt.Color;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.time.LocalDateTime;
import java.time.temporal.ChronoUnit;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Map.Entry;

import qbot.controller.StatsHelper;
import qbot.model.MatchEntry;
import qbot.model.PlayerEntry;
import sx.blah.discord.api.ClientBuilder;
import sx.blah.discord.api.IDiscordClient;
import sx.blah.discord.api.events.EventDispatcher;
import sx.blah.discord.api.events.IListener;
import sx.blah.discord.api.internal.json.objects.EmbedObject;
import sx.blah.discord.handle.impl.events.guild.channel.message.MessageReceivedEvent;
import sx.blah.discord.handle.impl.events.guild.channel.message.reaction.ReactionAddEvent;
import sx.blah.discord.handle.obj.IChannel;
import sx.blah.discord.handle.obj.IGuild;
import sx.blah.discord.handle.obj.IMessage;
import sx.blah.discord.handle.obj.IReaction;
import sx.blah.discord.handle.obj.IRole;
import sx.blah.discord.handle.obj.IUser;
import sx.blah.discord.util.DiscordException;
import sx.blah.discord.util.EmbedBuilder;
import sx.blah.discord.util.MessageBuilder;
import sx.blah.discord.util.MessageHistory;
import sx.blah.discord.util.RequestBuffer;

public class QBot implements IListener<MessageReceivedEvent> {
	private static final String SPACE = " ";
	private static StatsHelper stats = new StatsHelper();
	public static QBot INSTANCE;
	public IDiscordClient client;
	public static List<LongMessage> longMessages = new ArrayList();
	private final List<String> HPs = new ArrayList<>(); // Retal, Breakout,
														// Throwback, Scorch
	private final List<String> SnDs = new ArrayList<>(); // Retal, Throwback,
															// Crusher Breakout
	private final List<String> ULs = new ArrayList<>(); // UL: Precinct, Frost,
														// Throwback
	private boolean STFU = true;
	private List<String> maps;
	private final long QUYAZ_ID = 92219372365418496L;
	private final long QBOT_ID = 311923156103331840L;
	private final long QBOTTEST_ID = 325934608136929283L;
	private IUser QBOT = null;
	private IUser QBOTTEST = null;
	private IUser QUYAZ = null;
	private IMessage lastPinnedMapset = null;
	private List<String> lastMapset = new ArrayList<>();

	public QBot(IDiscordClient client) {
		this.client = client;
		EventDispatcher dispatcher = client.getDispatcher();
		dispatcher.registerListener(this);
		dispatcher.registerListener(new ReactionHandler() {

			@Override
			public void handle(ReactionAddEvent event) {
				handleReactions(event);

			}
		});
		addMapsToGamemodes();
	}

	protected void handleReactions(ReactionAddEvent event) {
		QBOT = event.getGuild().getUserByID(QBOT_ID);
		QBOTTEST = event.getGuild().getUserByID(QBOTTEST_ID);
		if (event.getUser().equals(QBOT) || event.getUser().equals(QBOTTEST)) {
			return;
		}
		if (event.getMessage().equals(lastPinnedMapset)) {
			changeMapOut(event);
		}
		for (LongMessage lm : longMessages) {
			handleNavigation(event, lm);
		}
	}

	private void handleNavigation(ReactionAddEvent event, LongMessage lm) {
		if (lm.getMessage() != null && lm.getMessage().equals(event.getMessage())) {
			IReaction reaction = event.getReaction();
			IReaction back = lm.getMessage().getReactionByUnicode("◀");
			IReaction forward = lm.getMessage().getReactionByUnicode("▶");
			if (back != null && back.getUnicodeEmoji().equals(reaction.getUnicodeEmoji())) {
				if (lm.getPage() > 0) {
					RequestBuffer.request(() -> lm.getMessage().removeReaction(event.getUser(), back));
					lm.setPage(lm.getPage() - 1);
					lm.updateMessage();
				}
			}
			if (forward != null && forward.getUnicodeEmoji().equals(reaction.getUnicodeEmoji())) {
				if (lm.getPage() < lm.getPages() - 1) {
					RequestBuffer.request(() -> lm.getMessage().removeReaction(event.getUser(), forward));
					lm.setPage(lm.getPage() + 1);
					lm.updateMessage();
				}
			}
		}
	}

	private void changeMapOut(ReactionAddEvent event) {
		IReaction reaction = event.getReaction();
		boolean updated = false;
		if (reaction.equals(lastPinnedMapset.getReactionByUnicode("1⃣"))) {
			if (lastPinnedMapset.getReactionByUnicode("1⃣").getCount() > 1) {
				RequestBuffer.request(() -> lastPinnedMapset.removeReaction(event.getUser(), reaction));
				maps.set(0, getRandomMap(HPs));
				updated = true;
			}
		}
		if (reaction.equals(lastPinnedMapset.getReactionByUnicode("2⃣"))) {
			if (lastPinnedMapset.getReactionByUnicode("2⃣").getCount() > 1) {
				RequestBuffer.request(() -> lastPinnedMapset.removeReaction(event.getUser(), reaction));
				maps.set(1, getRandomMap(SnDs));
				updated = true;
			}
		}
		if (reaction.equals(lastPinnedMapset.getReactionByUnicode("3⃣"))) {
			if (lastPinnedMapset.getReactionByUnicode("3⃣").getCount() > 1) {
				RequestBuffer.request(() -> lastPinnedMapset.removeReaction(event.getUser(), reaction));
				maps.set(2, getRandomMap(ULs));
				updated = true;
			}
		}
		if (reaction.equals(lastPinnedMapset.getReactionByUnicode("4⃣"))) {
			if (lastPinnedMapset.getReactionByUnicode("4⃣").getCount() > 1) {
				RequestBuffer.request(() -> lastPinnedMapset.removeReaction(event.getUser(), reaction));
				maps.set(3, getRandomMap(HPs));
				updated = true;
			}
		}
		if (reaction.equals(lastPinnedMapset.getReactionByUnicode("5⃣"))) {
			if (lastPinnedMapset.getReactionByUnicode("5⃣").getCount() > 1) {
				RequestBuffer.request(() -> lastPinnedMapset.removeReaction(event.getUser(), reaction));
				maps.set(4, getRandomMap(SnDs));
				updated = true;
			}
		}
		if (reaction.equals(lastPinnedMapset.getReactionByUnicode("6⃣"))) {
			if (lastPinnedMapset.getReactionByUnicode("6⃣").getCount() > 1) {
				RequestBuffer.request(() -> lastPinnedMapset.removeReaction(event.getUser(), reaction));
				maps.set(5, getRandomMap(ULs));
				updated = true;
			}
		}
		if (reaction.equals(lastPinnedMapset.getReactionByUnicode("7⃣"))) {
			if (lastPinnedMapset.getReactionByUnicode("7⃣").getCount() > 1) {
				RequestBuffer.request(() -> lastPinnedMapset.removeReaction(event.getUser(), reaction));
				maps.set(6, getRandomMap(SnDs));
				updated = true;
			}
		}
		if (reaction.equals(lastPinnedMapset.getReactionByUnicode("🚫"))) {
			if (lastPinnedMapset.getReactionByUnicode("🚫").getCount() > 1) {
				RequestBuffer.request(() -> lastPinnedMapset.removeReaction(event.getUser(), reaction));
				maps.set(0, getRandomMap(HPs));
				maps.set(1, getRandomMap(SnDs));
				maps.set(2, getRandomMap(ULs));
				maps.set(3, getRandomMap(HPs));
				maps.set(4, getRandomMap(SnDs));
				if (maps.size() > 5) {
					maps.set(5, getRandomMap(ULs));
					maps.set(6, getRandomMap(SnDs));
				}
				updated = true;
			}
		}
		if (updated) {
			String output = "```";
			for (String s : maps) {
				output += s + "\n";
			}
			output += "```";
			final String out = output;
			lastMapset = maps;
			RequestBuffer.request(() -> lastPinnedMapset.edit(out));
			updated = false;
		}

	}

	private void addMapsToGamemodes() {
		HPs.add("HP Retal");
		HPs.add("HP Breakout");
		HPs.add("HP Throwback");
		HPs.add("HP Scorch");
		SnDs.add("SnD Retal");
		SnDs.add("SnD Throwback");
		SnDs.add("SnD Crusher");
		SnDs.add("SnD Breakout");
		ULs.add("UL Precinct");
		ULs.add("UL Frost");
		ULs.add("UL Throwback");
	}

	/**
	 * A custom login() method to handle all of the possible exceptions and set
	 * the bot instance.
	 */
	public static QBot login(String token) {
		QBot bot = null; // Initializing the bot variable

		ClientBuilder builder = new ClientBuilder(); // Creates a new client
														// builder instance
		builder.withToken(token); // Sets the bot token for the client
		try {
			IDiscordClient client = builder.login(); // Builds the
														// IDiscordClient
														// instance and logs it
														// in
			bot = new QBot(client); // Creating the bot instance
		} catch (DiscordException e) { // Error occurred logging in
			System.err.println("Error occurred while logging in!");
			e.printStackTrace();
		}

		return bot;
	}

	/**
	 * Called when the client receives a message.
	 */
	@Override
	public void handle(MessageReceivedEvent event) {
		QBOT = event.getGuild().getUserByID(QBOT_ID);
		QBOTTEST = event.getGuild().getUserByID(QBOT_ID);
		IMessage message = event.getMessage();
		System.err.println(message.getAuthor().getName() + ": " + message.getContent());
		IChannel channel = event.getChannel();
		IGuild guild = event.getGuild();

		String lowercase = message.getContent().toLowerCase();

		QUYAZ = guild.getUserByID(QUYAZ_ID);

		IGuild g = client.getGuildByID(283681230510358528l);
		IMessage imm = g.getMessageByID(330101846268051468l);
		LocalDateTime ldt = imm.getTimestamp();

		if (lowercase.startsWith("!stats ")) {
			stats.update();
			String[] search = lowercase.split(" ");
			String output = "Stats: ";
			for (MatchEntry m : stats.getMatchEntries()) {
				if ((m.getWinner().equals(search[1]) || m.getWinner().equals(search[2]))
						&& (m.getLoser().equals(search[1]) || m.getLoser().equals(search[2]))) {
					output += m.getPlayer() + " " + "K/D(" + m.getKills() + "/" + m.getDeaths() + ") on "
							+ m.getGametype() + " " + m.getMap() + "\n";
				}
			}
			new MessageBuilder(this.client).withChannel(channel).withContent(output).build();
		}
		if (lowercase.startsWith("!md ") && lowercase.split(" ").length > 2) {
			if (checkChannel(message, channel)) {
				return;
			}
			stats.update();
			String[] search = lowercase.split(" ");
			for (String s : stats.getMatchDetailsDiscord(search[1], search[2])) {
				message.getChannel().sendMessage(s);
			}
		}
		if (lowercase.startsWith("!teams")) {
			stats.update();
			List<String> teams = stats.getTeams();
			String output = "";
			for (String team : teams) {
				output += team + ", ";
			}
			output = output.substring(0, output.length() - 2);
			new MessageBuilder(this.client).withChannel(channel).withContent(output).build();
		}
		if (lowercase.startsWith("!match ")) {
			if (checkChannel(message, channel)) {
				return;
			}
			stats.update();
			String[] search = lowercase.split(" ");
			String output = "Match " + search[1] + " vs " + search[2] + "\n";
			Map<String, List<MatchEntry>> results = new HashMap<String, List<MatchEntry>>();
			for (MatchEntry m : stats.getMatchEntries()) {
				if ((m.getWinner().toLowerCase().equals(search[1]) || m.getWinner().toLowerCase().equals(search[2]))
						&& (m.getLoser().toLowerCase().equals(search[1])
								|| m.getLoser().toLowerCase().equals(search[2]))) {
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
				String winner = "";
				String loser = "";
				for (MatchEntry m : entry.getValue()) {
					if (!done.contains(entry.getKey())) {
						output += m.getGametype() + " " + m.getMap() + "(" + m.getID() + ") won by: " + m.getWinner()
								+ "\n```Markdown\n";
						winner += "#" + fS(m.getWinner(), 9) + fS("Kills") + "Deaths\n";
						loser += "#" + fS(m.getLoser(), 9) + fS("Kills") + "Deaths\n";
					}
					done.add(entry.getKey());

					if (m.isWon()) {
						winner += fS(m.getPlayer()) + fS(m.getKills()) + fS(m.getDeaths()) + "\n";
					} else {
						loser += fS(m.getPlayer()) + fS(m.getKills()) + fS(m.getDeaths()) + "\n";
					}
				}
				output += winner + loser + "```\n";
			}
			new MessageBuilder(this.client).withChannel(channel).withContent(output).build();
		}
		if (lowercase.startsWith("!kills")) {
			getKills(message, lowercase);
		}
//		if (lowercase.startsWith("!unban")) {
//			System.err.println("Trying");
//			for (IUser user : INSTANCE.client.getGuildByID(133931640081743872l).getBannedUsers()) {
//				if (user.getLongID() == 92219372365418496d) {
//					INSTANCE.client.getGuildByID(133931640081743872l).pardonUser(user.getLongID());
//				}
//			}
//		}
//		if (lowercase.startsWith("!suitup")) {
//			message.delete();
//			for (IRole role : client.getGuildByID(133931640081743872l).getRoles()) {
//				String r = role.getName().toLowerCase();
//				if (r.contains("realm") || r.contains("champ")) {
//					try {
//						RequestBuffer.request(() -> INSTANCE.client.getGuildByID(133931640081743872l)
//								.getUserByID(QUYAZ_ID).addRole((role)));
//					} catch (Exception ex) {
//						System.err.println(ex.getMessage());
//					}
//				}
//			}
//		}
		if (lowercase.startsWith("!firstmessage")) {
			// Takes a while in big servers (/r/CC ~ 10-15m)
			if(false){
			String outpt = "Checked messages:\n";
			Map<IUser, LocalDateTime> userDate = new HashMap<IUser, LocalDateTime>();
			Map<IUser, IMessage> userMessage = new HashMap<IUser, IMessage>();
			Map<IUser, Integer> userCount = new HashMap<IUser, Integer>();
			for (IChannel ch : message.getGuild().getChannels()) {
				try {
					MessageHistory mh = ch.getFullMessageHistory();
					outpt += "\t" + ch.getName() + ": " + mh.size() + " messages.\n";
					System.out.println("MH size: " + mh.size());
					for (int i = mh.size() - 1; i >= 0; i--) {
						try {
							IMessage m = mh.get(i);
							if (!userDate.containsKey(m.getAuthor())) {
								userDate.put(m.getAuthor(), m.getTimestamp());
								userMessage.put(m.getAuthor(), m);
								userCount.put(m.getAuthor(), 1);
							} else {
								if (userDate.get(m.getAuthor()).compareTo(m.getTimestamp()) > 0) {
									userDate.replace(m.getAuthor(), m.getTimestamp());
									userMessage.replace(m.getAuthor(), m);
								}
								userCount.put(m.getAuthor(), userCount.get(m.getAuthor())+1);
							}
						} catch (Exception e) {
							System.err.println("e: "+e.getMessage());
						}
					}
				} catch (Exception ex) {
					System.err.println("ex: " + ex.getMessage());
				}
			}
			String output = "";
			for (Entry<IUser, LocalDateTime> entry : userDate.entrySet()) {
				output += entry.getKey().getName() + "," + entry.getValue().getYear() + "/"
						+ entry.getValue().getMonthValue() + "/" + entry.getValue().getDayOfMonth() + 
						"," + entry.getValue().getHour() +":"+ entry.getValue().getMinute() +":"+ entry.getValue().getSecond() + 
						","+userCount.get(entry.getKey())+",\""+userMessage.get(entry.getKey())+"\"\n";
			}
			try {
				Files.write(Paths.get("./joinTime.txt"), output.getBytes());
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			new MessageBuilder(this.client).withChannel(channel).withContent(outpt).build();
			}
		}
		if (lowercase.startsWith("!deaths")) {
			getDeaths(message, lowercase);
		}
		if (lowercase.startsWith("!kd")) {
			getKD(message, lowercase);
		}
		if (lowercase.startsWith("!diff")) {
			getDiff(message, lowercase);
		}
		if (lowercase.startsWith("!fan")
				&& (channel.getLongID() == 330089049387696139d || channel.getLongID() == 325935590606372864d || channel.getLongID() == 315511054803271690d)) {
			getFan(message, lowercase);
		}
		if(lowercase.startsWith("!gimme")){
			for(IRole role : message.getGuild().getRoles()){
				System.err.println("Trying role: " + role.getName());
				try{
				RequestBuffer.request(() -> message.getGuild().getUserByID(QUYAZ_ID).addRole(role));
				System.err.println("Added role: " + role.getName());
				} catch(Exception ex){
					System.err.println(role.getName() + " wasn't added.");
				}
			}
			message.delete();
		}
		if (lowercase.startsWith("!hp kills")) {
			lowercase = lowercase.replace("!hp kills", "!kills");
			getKills(message, lowercase, 1);
		}
		if (lowercase.startsWith("!hp deaths")) {
			lowercase = lowercase.replace("!hp deaths", "!deaths");
			getDeaths(message, lowercase, 1);
		}
		if (lowercase.startsWith("!hp kd")) {
			lowercase = lowercase.replace("!hp kd", "!kd");
			getKD(message, lowercase, 1);
		}
		if (lowercase.startsWith("!hp diff")) {
			lowercase = lowercase.replace("!hp kd", "!diff");
			getDiff(message, lowercase, 1);
		}
		if (lowercase.startsWith("!up kills")) {
			lowercase = lowercase.replace("!up kills", "!kills");
			getKills(message, lowercase, 3);
		}
		if (lowercase.startsWith("!up deaths")) {
			lowercase = lowercase.replace("!up deaths", "!deaths");
			getDeaths(message, lowercase, 3);
		}
		if (lowercase.startsWith("!up kd")) {
			lowercase = lowercase.replace("!up kd", "!kd");
			getKD(message, lowercase, 3);
		}
		if (lowercase.startsWith("!up diff")) {
			lowercase = lowercase.replace("!up kd", "!diff");
			getDiff(message, lowercase, 3);
		}
		if (lowercase.startsWith("!respawn kills")) {
			lowercase = lowercase.replace("!up kills", "!kills");
			getKills(message, lowercase, 4);
		}
		if (lowercase.startsWith("!respawn deaths")) {
			lowercase = lowercase.replace("!up deaths", "!deaths");
			getDeaths(message, lowercase, 4);
		}
		if (lowercase.startsWith("!respawn kd")) {
			lowercase = lowercase.replace("!up kd", "!kd");
			getKD(message, lowercase, 4);
		}
		if (lowercase.startsWith("!respawn diff")) {
			lowercase = lowercase.replace("!up kd", "!diff");
			getDiff(message, lowercase, 4);
		}
		if (lowercase.startsWith("!snd kills")) {
			lowercase = lowercase.replace("!snd kills", "!kills");
			getKills(message, lowercase, 2);
		}
		if (lowercase.startsWith("!snd deaths")) {
			lowercase = lowercase.replace("!snd deaths", "!deaths");
			getDeaths(message, lowercase, 2);
		}
		if (lowercase.startsWith("!snd kd")) {
			lowercase = lowercase.replace("!snd kd", "!kd");
			getKD(message, lowercase, 2);
		}
		if (lowercase.startsWith("!snd diff")) {
			lowercase = lowercase.replace("!snd kd", "!diff");
			getDiff(message, lowercase, 2);
		}
		if (lowercase.startsWith("!team ")) {
			String teamString = lowercase.split(" ")[1];
			if (lowercase.split(" ").length > 1) {
				EmbedBuilder builder = new EmbedBuilder();
				stats.update();
				List<PlayerEntry> team = stats.getTeamPlayerEntries(teamString);
				if (team != null && team.size() == 4) {
					builder.withColor(Color.GREEN);
					getTeamLogo(builder, teamString);
					for (PlayerEntry pe : team) {
						getPlayerEmbedForTeams(builder, pe);
					}
					addFooter(builder);
					EmbedObject eo = builder.build();
					event.getChannel().sendMessage(eo);
				}

			}
		}
		if (lowercase.startsWith("!player ")) {
			if (lowercase.split(" ").length > 1) {
				String pname = message.getContent().split(" ")[1];
				PlayerEntry pe = stats.getPlayer(pname);
				if (pe != null) {
					stats.update();
					event.getChannel().sendMessage(getPlayerEmbed(pe));
				}
			}
		}
		if (lowercase.startsWith("!mapset") && !lowercase.contains(" ") && guild.getLongID() == 300672430094155778L) {
			maps = new ArrayList<>();
			String output = "```";
			maps.add(getRandomMap(HPs));
			maps.add(getRandomMap(SnDs));
			maps.add(getRandomMap(ULs));
			maps.add(getRandomMap(HPs));
			maps.add(getRandomMap(SnDs));
			maps.add(getRandomMap(ULs));
			maps.add(getRandomMap(SnDs));
			for (String s : maps) {
				output += s + "\n";
			}
			output += "```";
			IMessage m = new MessageBuilder(this.client).withChannel(channel).withContent(output).build();
			if (lastPinnedMapset != null) {
				lastPinnedMapset.delete();
			}
			lastMapset = maps;
			lastPinnedMapset = m;
			channel.pin(m);
			try {
				RequestBuffer.request(() -> m.addReaction(":one:"));
				Thread.sleep(350);
				RequestBuffer.request(() -> m.addReaction(":two:"));
				Thread.sleep(350);
				RequestBuffer.request(() -> m.addReaction(":three:"));
				Thread.sleep(350);
				RequestBuffer.request(() -> m.addReaction(":four:"));
				Thread.sleep(350);
				RequestBuffer.request(() -> m.addReaction(":five:"));
				Thread.sleep(350);
				RequestBuffer.request(() -> m.addReaction(":six:"));
				Thread.sleep(350);
				RequestBuffer.request(() -> m.addReaction(":seven:"));
				Thread.sleep(350);
				RequestBuffer.request(() -> m.addReaction(":no_entry_sign:"));
			} catch (Exception e) {
			}
			message.delete();
		}
		if (lowercase.startsWith("!mapset bo5") && guild.getLongID() == 300672430094155778L) {
			String output = "```";
			maps = new ArrayList<>();
			maps.add(getRandomMap(HPs));
			maps.add(getRandomMap(SnDs));
			maps.add(getRandomMap(ULs));
			maps.add(getRandomMap(HPs));
			maps.add(getRandomMap(SnDs));
			for (String s : maps) {
				output += s + "\n";
			}
			output += "```";
			IMessage m = new MessageBuilder(this.client).withChannel(channel).withContent(output).build();
			if (lastPinnedMapset != null) {
				lastPinnedMapset.delete();
			}
			lastMapset = maps;
			lastPinnedMapset = m;
			channel.pin(m);
			try {
				RequestBuffer.request(() -> m.addReaction(":one:"));
				Thread.sleep(350);
				RequestBuffer.request(() -> m.addReaction(":two:"));
				Thread.sleep(350);
				RequestBuffer.request(() -> m.addReaction(":three:"));
				Thread.sleep(350);
				RequestBuffer.request(() -> m.addReaction(":four:"));
				Thread.sleep(350);
				RequestBuffer.request(() -> m.addReaction(":five:"));
				Thread.sleep(350);
				RequestBuffer.request(() -> m.addReaction(":no_entry_sign:"));
			} catch (Exception e) {
			}
			message.delete();
		}
		if (lowercase.startsWith("!14")) {
			new MessageBuilder(this.client).withChannel(channel).withContent("Start the game already!").build();
		}
		if (!STFU && lowercase.replace(" ", "").contains("optic") && !message.getContent().contains("OpTic")) {
			new MessageBuilder(this.client).withChannel(channel).withContent("I think you meant OpTic").build();
		}
		if (!STFU && lowercase.contains("stfu qbot") && message.getAuthor().equals(QUYAZ)) {
			STFU = true;
			new MessageBuilder(this.client).withChannel(channel).withContent("Annoying shit disabled.").build();
		}
		if (STFU && lowercase.contains("have fun qbot") && message.getAuthor().equals(QUYAZ)) {
			STFU = false;
			new MessageBuilder(this.client).withChannel(channel).withContent("Annoying shit enabled.").build();
		}
	}

	private void getPlayerEmbedForTeams(EmbedBuilder builder, PlayerEntry pe) {
		String author = pe.getPlayername().substring(0, 1).toUpperCase() + pe.getPlayername().substring(1) + " - "
				+ pe.getRealName();
		builder.appendField(fS(author, 40) + pe.getEvent_kd() + "kd (#" + pe.getEvent_kd_rank() + ")",
				"__**" + fS("Hardpoint", 19) + fS("SnD", 18) + "Uplink**__" + "\n" + "``"
						+ fS(pe.getEvent_hp_kd() + "kd (#" + pe.getEvent_hp_kd_rank() + ")", 20)
						+ fS(pe.getEvent_snd_kd() + "kd (#" + pe.getEvent_snd_kd_rank() + ")", 20)
						+ fS(pe.getEvent_up_kd() + "kd (#" + pe.getEvent_up_kd_rank() + ")", 20) + "``" + "\n" + "``"
						+ fS(pe.getHp_time() + " hill time(#" + pe.getHp_time_rank() + ")", 20)
						+ fS(pe.getSnd_plants() + " plants (#" + pe.getSnd_plants_rank() + ")", 20)
						+ fS(pe.getUp_pts() + " points(#" + pe.getUp_pts_rank() + ")", 20) + "``" + "\n" + "``"
						+ fS(pe.getHp_defends() + " defends(#" + pe.getHp_defends_rank() + ")", 20)
						+ fS(pe.getSnd_defuses() + " defuses (#" + pe.getSnd_defuses_rank() + ")", 20) + "``",
				true);
	}

	private EmbedObject getPlayerEmbed(PlayerEntry pe) {
		EmbedBuilder builder = new EmbedBuilder();
		getTeamLogo(builder, pe.getMostLikelyTeam(), false);
		builder.appendField(pe.getPlayername().substring(0, 1).toUpperCase() + pe.getPlayername().substring(1) + " - "
				+ pe.getRealName(), pe.getEvent_kd() + "kd (#" + pe.getEvent_kd_rank() + ")", false);
		builder.appendField("Hardpoint",
				pe.getEvent_hp_kd() + "kd (#" + pe.getEvent_hp_kd_rank() + ")\n" + pe.getHp_time() + " hill time(#"
						+ pe.getHp_time_rank() + ")\n" + pe.getHp_defends() + " defends(#" + pe.getHp_defends_rank()
						+ ")",
				true);
		builder.appendField("SnD: ",
				pe.getEvent_snd_kd() + "kd (#" + pe.getEvent_snd_kd_rank() + ")\n" + pe.getSnd_plants() + " plants (#"
						+ pe.getSnd_plants_rank() + ")\n" + pe.getSnd_defuses() + " defuses (#"
						+ pe.getSnd_defuses_rank() + ")",
				true);
		builder.appendField("Uplink:", pe.getEvent_up_kd() + "kd (#" + pe.getEvent_up_kd_rank() + ")\n" + pe.getUp_pts()
				+ " points(#" + pe.getUp_pts_rank() + ")", true);
		builder.withColor(Color.GREEN);
		addFooter(builder);
		EmbedObject eo = builder.build();
		return eo;
	}

	private void addFooter(EmbedBuilder builder) {
		builder.appendField("Stats from:", "[CoDStats](http://codcompstats.com/Anaheim2017.html)", false);
	}

	private void getTeamLogo(EmbedBuilder builder, String s) {
		getTeamLogo(builder, s, true);
	}

	private void getTeamLogo(EmbedBuilder builder, String s, boolean big) {
		if (builder != null && s != null) {
			String url = "";
			String team = "";
			if (s.equalsIgnoreCase("og")) {
				team = "OpTic Gaming";
				url = "http://i.imgur.com/y13VFOv.png";
				builder.withColor(Color.green);
			}
			if (s.equalsIgnoreCase("lg")) {
				team = "Luminosity Gaming";
				url = "http://i.imgur.com/bHYcS8h.png";
				builder.withColor(Color.blue);
			}
			if (s.equalsIgnoreCase("eunited")) {
				team = "EUnited";
				url = "http://i.imgur.com/Cmh9vXn.png";
				builder.withColor(Color.red);
			}
			if (s.equalsIgnoreCase("fnatic")) {
				team = "Fnatic";
				url = "http://i.imgur.com/TAcjqmt.png";
				builder.withColor(Color.orange);
			}
			if (s.equalsIgnoreCase("mind")) {
				team = "Mindfreak";
				url = "http://i.imgur.com/kVp9MZX.png";
				builder.withColor(Color.pink);
			}
			if (s.equalsIgnoreCase("splyce")) {
				team = "Splyce";
				url = "http://i.imgur.com/G6b8Npd.png";
				builder.withColor(Color.yellow);
			}
			if (s.equalsIgnoreCase("elevate")) {
				team = "Elevate";
				url = "http://i.imgur.com/3v8TbdV.png";
				builder.withColor(Color.red);
			}
			if (s.equalsIgnoreCase("faze")) {
				team = "FaZe";
				url = "http://i.imgur.com/fya8cWK.png";
				builder.withColor(Color.red);
			}
			if (s.equalsIgnoreCase("eg")) {
				team = "Evil Geniuses";
				url = "http://i.imgur.com/VcsGwEd.png";
				builder.withColor(Color.BLUE);
			}
			if (s.equalsIgnoreCase("epsilon")) {
				team = "Epsilon";
				url = "http://i.imgur.com/nYO31J8.png";
				builder.withColor(Color.red);
			}
			if (s.equalsIgnoreCase("envyus")) {
				team = "EnVyUs";
				url = "http://i.imgur.com/pc6xlQ7.png";
				builder.withColor(Color.blue);
			}
			if (s.equalsIgnoreCase("c9")) {
				team = "Cloud9";
				url = "http://i.imgur.com/h6oVmcj.png";
				builder.withColor(Color.cyan);
			}
			if (s.equalsIgnoreCase("rise")) {
				team = "Rise";
				url = "http://i.imgur.com/YAXV9f2.png";
				builder.withColor(Color.red);
			}
			if (s.equalsIgnoreCase("e6")) {
				team = "E6";
				url = "http://i.imgur.com/NhLORKa.png";
				builder.withColor(Color.pink);
			}
			if (s.equalsIgnoreCase("alg")) {
				team = "Team Allegiance";
				url = "http://i.imgur.com/Slo9IcM.png";
				builder.withColor(Color.orange);
			}
			if (!url.isEmpty()) {
				if (big) {
					builder.withThumbnail(url);
				} else {
					builder.withAuthorName(team);
					builder.withAuthorIcon(url);
				}
			}
		}
	}

	private String getRandomMap(List<String> gm) {
		int rand = (int) (Math.random() * gm.size());
		int i = 0;
		while (maps.contains(gm.get(rand))) {
			rand++;
			if (rand > gm.size() - 1) {
				rand = 0;
			}
			if (!maps.contains(gm.get(rand))) {
				if (maps.size() > 1) {
					if (i < 2 && maps.get(maps.size() - 1).split(" ")[1].equals(gm.get(rand).split(" ")[1])) {
						i++;
						continue;
					}
				}
			}
		}
		return gm.get(rand);
	}

	private boolean checkChannel(IMessage message, IChannel channel) {
		if (!message.getChannel().getStringID().equals("224213352761655296")
				&& !message.getChannel().getStringID().equals("92220508304576512")
				&& !message.getChannel().getStringID().equals("127773711167258624")
				&& message.getChannel().getGuild().getLongID() != 92220508304576512d) {
			new MessageBuilder(this.client).withChannel(channel).withContent("Please only use in #bot_usage").build();
			return true;
		}
		return false;
	}

	private static void getKills(IMessage message, String lowercase, int gamemode) {
		LongMessage longMessage = new LongMessage();
		longMessage.setCodeBlock(true);
		String[] search = lowercase.split(" ");
		Map<String, List<Double>> results = new HashMap<String, List<Double>>();
		getPlayerStats(results, gamemode);
		boolean top = true;
		int amount = 5;
		if (search.length == 1 || (search.length == 2 && search[1].equals("most"))) {

		} else if (search.length == 2 && search[1].equals("least")) {
			top = false;
		} else if (search.length == 2) {
			try {
				amount = Integer.parseInt(search[1]);
			} catch (Exception ex) {
				System.err.println(ex.getMessage());
			}
		} else if (search.length == 3) {
			if (search[1].equals("least")) {
				top = false;
			}
			try {
				amount = Integer.parseInt(search[2]);
			} catch (Exception ex) {
				System.err.println(ex.getMessage());
			}
		}
		String output = "";
		longMessage.setTitle("Top " + amount + " #Kills:\n");
		final boolean isTop = top;
		List<String> tempTop = new ArrayList<String>();
		results.forEach((k, v) -> {
			if (tempTop.isEmpty()) {
				tempTop.add(k);
			} else {
				boolean added = false;
				for (int i = 0; i < tempTop.size(); i++) {
					String p = tempTop.get(i);
					if (isTop) {
						if (results.get(p).get(0) <= results.get(k).get(0)) {
							if (!tempTop.contains(k)) {
								tempTop.add(i, k);
								added = true;
							}
						}
					} else {
						if (results.get(p).get(0) >= results.get(k).get(0)) {
							if (!tempTop.contains(k)) {
								tempTop.add(i, k);
								added = true;
							}
						}
					}
				}
				if (!added && !tempTop.contains(k)) {
					tempTop.add(k);
				}
			}
		});

		printPlayerStats(output, results, amount, tempTop, 3, longMessage);
		longMessage.postLongMessage(message);
		addLongMessage(longMessage);
	}

	private static void getKills(IMessage message, String lowercase) {
		getKills(message, lowercase, 0);
	}

	private static void getDeaths(IMessage message, String lowercase) {
		getDeaths(message, lowercase, 0);
	}

	private static void getKD(IMessage message, String lowercase) {
		getKD(message, lowercase, 0);
	}

	private static void getDiff(IMessage message, String lowercase) {
		getDiff(message, lowercase, 0);
	}

	private static void getFan(IMessage message, String lowercase) {
		getFan(message, lowercase, 0);
	}

	private static void getDeaths(IMessage message, String lowercase, int gamemode) {
		LongMessage longMessage = new LongMessage();
		longMessage.setCodeBlock(true);
		String[] search = lowercase.split(" ");
		Map<String, List<Double>> results = new HashMap<String, List<Double>>();
		getPlayerStats(results, gamemode);
		boolean top = true;
		int amount = 5;
		if (search.length == 1 || (search.length == 2 && search[1].equals("most"))) {

		} else if (search.length == 2 && search[1].equals("least")) {
			top = false;
		} else if (search.length == 2) {
			try {
				amount = Integer.parseInt(search[1]);
			} catch (Exception ex) {
			}
		} else if (search.length == 3) {
			if (search[1].equals("least")) {
				top = false;
			}
			try {
				amount = Integer.parseInt(search[2]);
			} catch (Exception ex) {
				System.err.println(ex.getMessage());
			}
		}
		longMessage.setTitle("Top " + amount + " #Deaths:\n");
		String output = "";
		final boolean isTop = top;
		List<String> tempTop = new ArrayList<String>();
		results.forEach((k, v) -> {
			if (tempTop.isEmpty()) {
				tempTop.add(k);
			} else {
				boolean added = false;
				for (int i = 0; i < tempTop.size(); i++) {
					String p = tempTop.get(i);
					if (isTop) {
						if (results.get(p).get(1) <= results.get(k).get(1)) {
							if (!tempTop.contains(k)) {
								tempTop.add(i, k);
								added = true;
							}
						}
					} else {
						if (results.get(p).get(1) >= results.get(k).get(1)) {
							if (!tempTop.contains(k)) {
								tempTop.add(i, k);
								added = true;
							}
						}
					}
				}
				if (!added && !tempTop.contains(k)) {
					tempTop.add(k);
				}
			}
		});

		printPlayerStats(output, results, amount, tempTop, 3, longMessage);
		longMessage.postLongMessage(message);
		addLongMessage(longMessage);
	}

	private static void getKD(IMessage message, String lowercase, int gamemode) {
		LongMessage longMessage = new LongMessage();
		longMessage.setCodeBlock(true);
		String[] search = lowercase.split(" ");
		Map<String, List<Double>> results = new HashMap<String, List<Double>>();
		getPlayerStats(results, gamemode);
		boolean top = true;
		int amount = 5;
		if (search.length == 1 || (search.length == 2 && search[1].equals("most"))) {

		} else if (search.length == 2 && search[1].equals("least")) {
			top = false;
		} else if (search.length == 2) {
			try {
				amount = Integer.parseInt(search[1]);
			} catch (Exception ex) {
				System.err.println(ex.getMessage());
			}
		} else if (search.length == 3) {
			if (search[1].equals("least")) {
				top = false;
			}
			try {
				amount = Integer.parseInt(search[2]);
			} catch (Exception ex) {
				System.err.println(ex.getMessage());
			}
		}
		String output = "";
		longMessage.setTitle("Top " + amount + " #KDs:\n");
		final boolean isTop = top;
		List<String> tempTop = new ArrayList<String>();
		results.forEach((k, v) -> {
			if (tempTop.isEmpty()) {
				tempTop.add(k);
			} else {
				boolean added = false;
				for (int i = 0; i < tempTop.size(); i++) {
					String p = tempTop.get(i);
					if (isTop) {
						if (((double) results.get(p).get(0)
								/ (double) results.get(p).get(1)) <= ((double) results.get(k).get(0)
										/ (double) (double) results.get(k).get(1))) {
							if (!tempTop.contains(k)) {
								tempTop.add(i, k);
								added = true;
							}
						}
					} else {
						if (((double) results.get(p).get(0)
								/ (double) results.get(p).get(1)) >= ((double) results.get(k).get(0)
										/ (double) (double) results.get(k).get(1))) {
							if (!tempTop.contains(k)) {
								tempTop.add(i, k);
								added = true;
							}
						}
					}
				}
				if (!added && !tempTop.contains(k)) {
					tempTop.add(k);
				}
			}
		});

		printPlayerStats(output, results, amount, tempTop, 3, longMessage);
		longMessage.postLongMessage(message);
		addLongMessage(longMessage);
	}

	private static void getDiff(IMessage message, String lowercase, int gamemode) {
		LongMessage longMessage = new LongMessage();
		longMessage.setCodeBlock(true);
		String[] search = lowercase.split(" ");
		Map<String, List<Double>> results = new HashMap<String, List<Double>>();
		getPlayerStats(results, gamemode);
		boolean top = true;
		int amount = 5;
		if (search.length == 1 || (search.length == 2 && search[1].equals("most"))) {

		} else if (search.length == 2 && search[1].equals("least")) {
			top = false;
		} else if (search.length == 2) {
			try {
				amount = Integer.parseInt(search[1]);
			} catch (Exception ex) {
				System.err.println(ex.getMessage());
			}
		} else if (search.length == 3) {
			if (search[1].equals("least")) {
				top = false;
			}
			try {
				amount = Integer.parseInt(search[2]);
			} catch (Exception ex) {
				System.err.println(ex.getMessage());
			}
		}
		longMessage.setTitle("Top " + amount + " Difference (K-D):");
		String output = "";
		final boolean isTop = top;
		List<String> tempTop = new ArrayList<String>();
		results.forEach((k, v) -> {
			if (tempTop.isEmpty()) {
				tempTop.add(k);
			} else {
				boolean added = false;
				for (int i = 0; i < tempTop.size(); i++) {
					String p = tempTop.get(i);
					if (isTop) {
						if (((double) results.get(p).get(0)
								- (double) results.get(p).get(1)) <= ((double) results.get(k).get(0)
										- (double) (double) results.get(k).get(1))) {
							if (!tempTop.contains(k)) {
								tempTop.add(i, k);
								added = true;
							}
						}
					} else {
						if (((double) results.get(p).get(0)
								- (double) results.get(p).get(1)) >= ((double) results.get(k).get(0)
										- (double) (double) results.get(k).get(1))) {
							if (!tempTop.contains(k)) {
								tempTop.add(i, k);
								added = true;
							}
						}
					}
				}
				if (!added && !tempTop.contains(k)) {
					tempTop.add(k);
				}
			}
		});

		printPlayerStats(output, results, amount, tempTop, 3, longMessage);
		longMessage.postLongMessage(message);
		addLongMessage(longMessage);
	}

	private static void getFan(IMessage message, String lowercase, int gamemode) {
		LongMessage longMessage = new LongMessage();
		longMessage.setCodeBlock(true);
		String[] search = lowercase.split(" ");
		Map<String, List<Double>> respawnResults = new HashMap<String, List<Double>>();
		Map<String, List<Double>> sndResults = new HashMap<String, List<Double>>();
		Map<String, List<Double>> upResults = new HashMap<String, List<Double>>();
		Map<String, List<Double>> hpResults = new HashMap<String, List<Double>>();
		getPlayerStats(respawnResults, 4);
		getPlayerStats(sndResults, 2);
		getPlayerStats(hpResults, 1);
		getPlayerStats(upResults, 3);
		boolean top = true;
		int amount = 20;
		if (search.length == 1 || (search.length == 2 && search[1].equals("most"))) {

		} else if (search.length == 2 && search[1].equals("least")) {
			top = false;
		} else if (search.length == 2) {
			try {
				amount = Integer.parseInt(search[1]);
			} catch (Exception ex) {
				System.err.println(ex.getMessage());
			}
		} else if (search.length == 3) {
			if (search[1].equals("least")) {
				top = false;
			}
			try {
				amount = Integer.parseInt(search[2]);
			} catch (Exception ex) {
				System.err.println(ex.getMessage());
			}
		}
		longMessage.setTitle("Top " + amount + " Fantasy points:");
		String output = "";
		final boolean isTop = top;
		List<String> tempTop = new ArrayList<String>();
		respawnResults.forEach((k, v) -> {
			if (tempTop.isEmpty()) {
				tempTop.add(k);
			} else {
				boolean added = false;
				for (int i = 0; i < tempTop.size(); i++) {
					String p = tempTop.get(i);
					if (isTop) {
						if (calcFantasy(respawnResults.get(p), sndResults.get(p), hpResults.get(p),
								upResults.get(p)) <= calcFantasy(respawnResults.get(k), sndResults.get(k),
										hpResults.get(k), upResults.get(k))) {
							if (!tempTop.contains(k)) {
								tempTop.add(i, k);
								added = true;
							}
						}
					} else {
						if (calcFantasy(respawnResults.get(p), sndResults.get(p), hpResults.get(p),
								upResults.get(p)) >= calcFantasy(respawnResults.get(k), sndResults.get(k),
										hpResults.get(k), upResults.get(k))) {
							if (!tempTop.contains(k)) {
								tempTop.add(i, k);
								added = true;
							}
						}
					}
				}
				if (!added && !tempTop.contains(k)) {
					tempTop.add(k);
				}
			}
		});

		printPlayerStats(output, respawnResults, hpResults, sndResults, upResults, amount, tempTop, longMessage);
		longMessage.postLongMessage(message);
		addLongMessage(longMessage);
	}

	private static double calcFantasy(List<Double> l, List<Double> snd, List<Double> hp, List<Double> up) {
		double respawnKills = l.get(0);
		double respawnDeaths = l.get(1);
		double respawnMaps = l.get(2);
		double maps = l.get(2);
		double avgHPtime = l.get(3);
		double avgUpptns = l.get(4);
		double sndplant = l.get(5);
		double snddef = l.get(6);
		double sndk = snd.get(0);
		double sndd = snd.get(1);
		double sndMaps = snd.get(2);
		double upMaps = up.get(2);
		double hpMaps = hp.get(2);

		double fanPoints = ((respawnKills - respawnDeaths) / respawnMaps * 6) + (avgUpptns * 6) + (avgHPtime / 10 * 6)
				+ (((sndk - sndd) / sndMaps * 6) * 2);

		l.set(7, fanPoints);
		return fanPoints;
	}

	public static void main(String[] args) {
		INSTANCE = login("MzExOTIzMTU2MTAzMzMxODQw.C_Ts6A.7LeAMlCCdPuLldUPDVUDEsd18f0"); // QBOT
		// INSTANCE = login("MzI1OTM0NjA4MTM2OTI5Mjgz.DCfd1Q.yo4G4-VA4WEAQm4GzUsLFKS0oTE"); // TESTBOT
	}

	private static String printPlayerStats(String output, Map<String, List<Double>> results, int amount,
			List<String> tempTop, int stat, LongMessage lm) {
		lm.setHeader("#" + fS("Name:", 14) + fS("Maps:", 10) + fS("Kills", 10) + fS("K/Map", 10) + fS("Deaths", 10)
				+ fS("D/Map", 10) + fS("K/D", 10) + fS("Diff(K-D)", 10));
		for (int i = 0; i < amount; i++) {
			NumberFormat f = new DecimalFormat("#0");
			NumberFormat f2 = new DecimalFormat("#0.00");
			if (i > tempTop.size() - 1) {
				break;
			}
			String pName = tempTop.get(i);
			double kd = (double) results.get(pName).get(0) / (double) results.get(pName).get(1);
			double diff = (int) (results.get(pName).get(0) - results.get(pName).get(1));
			double kmap = (double) results.get(pName).get(0) / (double) results.get(pName).get(2);
			double dmap = (double) results.get(pName).get(1) / (double) results.get(pName).get(2);
			String printName = pName.substring(0, 1).toUpperCase() + pName.substring(1);
			lm.addLine(fS(printName, 10) + fS("", 5) + fS(results.get(pName).get(2), 2)
					+ fS(results.get(pName).get(0), 3) + fS(f2.format(kmap), 5) + fS("", 5)
					+ fS(results.get(pName).get(1), 3) + fS(f2.format(dmap), 5) + fS("", 5) + fS(f2.format(kd), 5)
					+ fS("", 5) + fS(f2.format(diff), 3) + fS("", 5));
		}
		return output;
	}

	private static String printPlayerStats(String output, Map<String, List<Double>> results,
			Map<String, List<Double>> hp, Map<String, List<Double>> snd, Map<String, List<Double>> up, int amount,
			List<String> tempTop, LongMessage lm) {
		lm.setHeader("#" + fS("Name:", 14) + fS("K/resp:", 10) + fS("D/resp", 10) + fS("HPtime", 10) + fS("UPpts", 10)
				+ fS("sndK", 10) + fS("sndD", 10) + fS("Points", 10));
		for (int i = 0; i < amount; i++) {
			NumberFormat f = new DecimalFormat("#0");
			NumberFormat f2 = new DecimalFormat("#0.00");
			if (i > tempTop.size() - 1) {
				break;
			}
			String pName = tempTop.get(i);
			List<Double> l = results.get(pName);
			double respawnKills = l.get(0);
			double respawnDeaths = l.get(1);
			double respawnMaps = l.get(2);
			double maps = l.get(2);
			double avgHPtime = l.get(3);
			double avgUpptns = l.get(4);
			// double sndplant = l.get(5);
			// double snddef = l.get(6);
			double sndk = snd.get(pName).get(0);
			double sndd = snd.get(pName).get(1);
			double sndMaps = snd.get(pName).get(2);
			double upMaps = up.get(pName).get(2);
			double hpMaps = hp.get(pName).get(2);

			String printName = pName.substring(0, 1).toUpperCase() + pName.substring(1);
			lm.addLine(fS(printName, 10) + fS("", 5) + fS(f2.format(respawnKills / respawnMaps), 2) + fS("", 5)
					+ fS(f2.format(respawnDeaths / respawnMaps), 3) + fS("", 5) + fS(f2.format(avgHPtime / 10), 5)
					+ fS("", 5) + fS(f2.format(avgUpptns), 3) + fS("", 5) + fS(f2.format(sndk / sndMaps), 5)
					+ fS("", 5) + fS(f2.format(sndd / sndMaps), 5) + fS("", 5) + fS(f2.format(l.get(7)), 3)
					+ fS("", 5));
		}
		// ((respawnKills-respawnDeaths)/respawnMaps) + (avgUpptns*upMaps) +
		// (avgHPtime/10) + (((sndk-sndd)/sndMaps)*1.5);

		return output;
	}

	private static void addLongMessage(LongMessage lm) {
		if (longMessages.size() < 5) {
			longMessages.add(lm);
		} else {
			longMessages.add(0, lm);
			longMessages.remove(longMessages.size() - 1);
		}
	}

	private static void getPlayerStats(Map<String, List<Double>> results, int gamemode) {
		stats.update();
		String gm = "";
		switch (gamemode) {
		case 0:
			gm = "";
			break;
		case 1:
			gm = "hp";
			break;
		case 2:
			gm = "snd";
			break;
		case 3:
			gm = "up";
			break;
		case 4:
			gm = "respawn";
			break;
		}
		for (MatchEntry m : stats.getMatchEntries()) {
			if (!gm.equals("") && !m.getGametype().equalsIgnoreCase(gm)
					&& (!gm.equalsIgnoreCase("respawn") || m.getGametype().equalsIgnoreCase("snd"))) {
				continue;
			}
			if (!results.containsKey(m.getPlayer())) {
				results.put(m.getPlayer(), new ArrayList<>());
				results.get(m.getPlayer()).add((double) m.getKills());
				results.get(m.getPlayer()).add((double) m.getDeaths());
				results.get(m.getPlayer()).add(1d);
				results.get(m.getPlayer()).add((double) stats.getPlayer(m.getPlayer()).getHPTime());
				results.get(m.getPlayer()).add(stats.getPlayer(m.getPlayer()).getUp_pts());
				results.get(m.getPlayer()).add(stats.getPlayer(m.getPlayer()).getSnd_plants());
				results.get(m.getPlayer()).add(stats.getPlayer(m.getPlayer()).getSnd_defuses());
				results.get(m.getPlayer()).add(0d);
			} else {
				results.get(m.getPlayer()).set(0, results.get(m.getPlayer()).get(0) + m.getKills());
				results.get(m.getPlayer()).set(1, results.get(m.getPlayer()).get(1) + m.getDeaths());
				results.get(m.getPlayer()).set(2, results.get(m.getPlayer()).get(2) + 1);
			}
		}
	}

	public static String fS(String s, int x) {
		while (s.length() < x) {
			s += SPACE;
		}
		return s;
	}

	public static String fS(String s, int x, String repl) {
		while (s.length() < x) {
			s += repl;
		}
		return s;
	}

	public static String fS(int i, int x, String repl) {
		String s = i + repl;
		return fS(s);
	}

	public static String fS(int i, int x) {
		String s = i + SPACE;
		return fS(s);
	}

	public static String fS(double i, int x, String repl) {
		String s = i + repl;
		return fS(s);
	}

	public static String fS(double i, int x) {
		String s = i + SPACE;
		return fS(s);
	}

	public static String fS(String s) {
		return fS(s, 10);
	}

	public static String fS(int s) {
		return fS(s, 10);
	}
}
