package qbot.view.swing;

import java.awt.BorderLayout;
import java.awt.Dimension;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTextArea;
import javax.swing.ScrollPaneConstants;
import javax.swing.WindowConstants;

import qbot.controller.StatsHelper;

/**
 * Dario Jeurissen
 * Date: 27/03/14
 */
public class CoDStats extends JFrame{
    private JLabel team, team1, team2, selectATeam, output; 
    private JComboBox<String> combo1, combo2;
    private JTextArea outputArea;
    private JScrollPane scrollpane;
    private JButton searchButton;
    private JButton updateButton;
    private JPanel main, top, topleft, topright, topmid, mid, bottom;
    private final StatsHelper stats = new StatsHelper();
    public CoDStats(){
        makeComponents();
        makeLayout();
        addListeners();
        showFrame();
    }

    @SuppressWarnings("unchecked")
	private void makeComponents() {
    	team = new JLabel("Choose a team:");
    	team1 = new JLabel("Team 1:");
    	team2 = new JLabel("Team 2:");
    	output = new JLabel("Results:");
    	combo1 = new JComboBox(stats.getTeams().toArray());
    	combo2 = new JComboBox(stats.getTeams().toArray());
    	outputArea = new JTextArea();
    	scrollpane = new JScrollPane(outputArea);
    	outputArea.setSize(300, 200);
    	searchButton = new JButton("Search");
    	updateButton = new JButton("Update");
    	
    	main = new JPanel();
    	top = new JPanel();
    	topleft = new JPanel();
    	topright = new JPanel();
    	mid = new JPanel();
    	bottom = new JPanel();
    }

    private void makeLayout() {
    	main.add(top, BorderLayout.NORTH);
        top.setLayout(new GridLayout(1, 4));
        top.add(topleft);
        topleft.add(team1);
        topleft.add(combo1);
        top.add(topright);
        topright.add(team2);
        topright.add(combo2);
        top.add(mid);
        mid.add(searchButton);
        mid.add(updateButton);
        
        scrollpane.setPreferredSize(new Dimension(400, 200));
        scrollpane.setVerticalScrollBarPolicy(ScrollPaneConstants.VERTICAL_SCROLLBAR_ALWAYS);
        main.add(scrollpane, BorderLayout.CENTER);
        scrollpane.revalidate();
        scrollpane.revalidate();
        add(main, BorderLayout.CENTER);
    }

    private void addListeners() {
        searchButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
            	String outputStats = "";
            	for(String s : stats.getMatchDetails((String) combo1.getSelectedItem(), (String)combo2.getSelectedItem())){
            		outputStats += s;
            	}
                outputArea.setText(outputStats);
                revalidate();
                doLayout();
            }
        });
        searchButton.addActionListener(new ActionListener() {
			@Override
			public void actionPerformed(ActionEvent e) {
				stats.update();
			}
		});
        
    }

    public void showFrame() {
        setTitle("Get MLG STATS");
        setSize(500, 350);
        setVisible(true);
        setDefaultCloseOperation(WindowConstants.EXIT_ON_CLOSE);
    }
}
