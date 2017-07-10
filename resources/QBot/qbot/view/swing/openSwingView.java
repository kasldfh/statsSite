package qbot.view.swing;

import qbot.view.QBot;

public class openSwingView {
	public static void main(String[] args) {
		CoDStats cs = new CoDStats();
		cs.showFrame();
		QBot qbot = QBot.login("MzExOTIzMTU2MTAzMzMxODQw.C_Ts6A.7LeAMlCCdPuLldUPDVUDEsd18f0");
	}
}
