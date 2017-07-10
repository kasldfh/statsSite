package qbot.view;

import java.awt.print.Pageable;
import java.util.ArrayList;
import java.util.List;

import sx.blah.discord.handle.obj.IMessage;
import sx.blah.discord.util.RequestBuffer;

public class LongMessage {
	private final static int PAGE_LINES = 10;
	private int pageLines = 0;
	private int page = 0;
	private String title = "";
	private List<List<String>> pages;
	private IMessage message;
	private boolean codeBlock;
	private String header = "";;

	public LongMessage() {
		this.pageLines = PAGE_LINES;
		this.pages = new ArrayList<>();
		this.pages.add(new ArrayList());
	}

	public void addLine(String s) {
		boolean done = true;
		for (List<String> page : pages) {
			if (page.size() < PAGE_LINES) {
				page.add(s);
				done = true;
			} else {
				done = false;
			}
		}
		if (!done) {
			pages.add(new ArrayList());
			addLine(s);
		}
	}

	public int getPages() {
		return pages.size();
	}

	public IMessage getMessage() {
		return message;
	}

	@Override
	public String toString() {
		String output = title + "\n";
		if (codeBlock) {
			output += "```Markdown\n";
		}
		output += header + "\n";
		for (String s : pages.get(page)) {
			output += s + "\n";
		}
		if (codeBlock) {
			output += "```\n";
		}
		if (pages.size() > 1) {
			output += "Page [" + (page + 1) + "/" + pages.size() + "] Use emojis to switch page";
		}
		return output;
	}

	public int getPageLines() {
		return pageLines;
	}

	public void setPageLines(int pageLines) {
		this.pageLines = pageLines;
	}

	public int getPage() {
		return page;
	}

	public void setPage(int page) {
		this.page = page;
	}

	public String getTitle() {
		return title;
	}

	public void setTitle(String title) {
		this.title = title;
	}

	public IMessage postLongMessage(IMessage msg) {
		this.message = msg.getChannel().sendMessage(toString());
		addReactions(message);
		return message;
	}

	public void updateMessage() {
		this.message.edit(toString());
		addReactions(message);
	}

	private void addReactions(IMessage mess) {
		try {
			if (pages.size() > 1) {
				RequestBuffer.request(() -> mess.addReaction(":arrow_backward:"));
				Thread.sleep(350);
				RequestBuffer.request(() -> mess.addReaction(":arrow_forward:"));
			}
		} catch (Exception e) {
		}
	}

	public boolean isCodeBlock() {
		return codeBlock;
	}

	public void setCodeBlock(boolean codeBlock) {
		this.codeBlock = codeBlock;
	}

	public String getHeader() {
		return header;
	}

	public void setHeader(String header) {
		this.header = header;
	}
}
