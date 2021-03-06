/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controller;

import ejecutes.AdminMenu;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.JOptionPane;
import model.Member;
import model.Model;


/**
 *
 * @author oihan
 */
public class MemberController implements ActionListener {
    /**
     * Private atributes
     */
    private Model model;
    private ViewMembers viewMembers;
    /**
     * Constructor
     * @param model Model
     * @param viewMembers  ViewMembers
     */
    public MemberController(Model model, ViewMembers viewMembers) {
        this.model = model;
        this.viewMembers = viewMembers;
        anadirActionListener(this);
        
    }
    /**
     * Called just after the user performs an action.
     * @param listener 
     */
    private void anadirActionListener(ActionListener listener) {
        viewMembers.jButton1.addActionListener(listener);
        viewMembers.jButton2.addActionListener(listener);
        viewMembers.jButton3.addActionListener(listener);
        viewMembers.jButton4.addActionListener(listener);
    }
    /**
     * Invoked when an action occurs.
     * @param e the event to be processed
     */
    @Override
    public void actionPerformed(ActionEvent e) {
        String actionCommand = e.getActionCommand();
        switch (actionCommand) {
            case "Add":
                try{
                    Member m=new Member(viewMembers.jTextField1.getText(),viewMembers.jTextField2.getText(),viewMembers.jTextField3.getText(),viewMembers.jTextField4.getText(),viewMembers.jTextField5.getText(),viewMembers.jCheckBox1.isSelected(),Double.parseDouble(viewMembers.jTextField6.getText()),Double.parseDouble(viewMembers.jTextField7.getText()),viewMembers.jTextField8.getText());
                    model.addMember(m);
                    this.viewMembers.setVisible(false);
                    ViewMembers view2 = ViewMembers.viewaSortuBistaratu();
                    Model model2 = new Model();
                    MemberController controller = new MemberController (model2, view2);
                    break; 
                }catch(NumberFormatException n){
                    JOptionPane.showMessageDialog(null,n.getMessage());
                    break;
                }
            case "Delete":
                if(viewMembers.jTable1.getSelectedRow()!=-1){
                    Member me=new Member((String)viewMembers.jTable1.getModel().getValueAt(viewMembers.jTable1.getSelectedRow(), 0),(String)viewMembers.jTable1.getModel().getValueAt(viewMembers.jTable1.getSelectedRow(), 1),(String)viewMembers.jTable1.getModel().getValueAt(viewMembers.jTable1.getSelectedRow(), 2),(String)viewMembers.jTable1.getModel().getValueAt(viewMembers.jTable1.getSelectedRow(), 3),(String)viewMembers.jTable1.getModel().getValueAt(viewMembers.jTable1.getSelectedRow(), 4),(boolean)viewMembers.jTable1.getModel().getValueAt(viewMembers.jTable1.getSelectedRow(), 5),(double)viewMembers.jTable1.getModel().getValueAt(viewMembers.jTable1.getSelectedRow(), 6),(double)viewMembers.jTable1.getModel().getValueAt(viewMembers.jTable1.getSelectedRow(), 7),(String)viewMembers.jTable1.getModel().getValueAt(viewMembers.jTable1.getSelectedRow(), 8));
                    model.deleteMember(me);
                    this.viewMembers.setVisible(false);
                    ViewMembers view1 = ViewMembers.viewaSortuBistaratu();
                    Model model1 = new Model();
                    MemberController controller1 = new MemberController (model1, view1);
                    
                    
                }else{
                    JOptionPane.showMessageDialog(null,"You have to seelct row");
                }
                break;
            case "Update":
                if (viewMembers.jTable1.getSelectedRow()!=-1) {
                    String dni = (String)viewMembers.jTextField1.getText();
                    String name = (String) viewMembers.jTextField2.getText();
                    String surname = (String) viewMembers.jTextField3.getText();
                    String gmail=(String) viewMembers.jTextField4.getText();
                    String password=(String) viewMembers.jTextField5.getText();
                    boolean admin=(boolean) viewMembers.jCheckBox1.isSelected();
                    double moneyPay = Double.parseDouble(viewMembers.jTextField6.getText());
                    double moneyAccount= Double.parseDouble(viewMembers.jTextField7.getText());
                    String photo=(String) viewMembers.jTextField8.getText();
                    
                    viewMembers.jTable1.setValueAt(dni, viewMembers.jTable1.getSelectedRow(), 0);
                    viewMembers.jTable1.setValueAt(name, viewMembers.jTable1.getSelectedRow(), 1);
                    viewMembers.jTable1.setValueAt(surname, viewMembers.jTable1.getSelectedRow(), 2);
                    viewMembers.jTable1.setValueAt(gmail, viewMembers.jTable1.getSelectedRow(), 3);
                    viewMembers.jTable1.setValueAt(password, viewMembers.jTable1.getSelectedRow(), 4);
                    viewMembers.jTable1.setValueAt(admin, viewMembers.jTable1.getSelectedRow(), 5);
                    viewMembers.jTable1.setValueAt(moneyPay, viewMembers.jTable1.getSelectedRow(), 6);
                    viewMembers.jTable1.setValueAt(moneyAccount, viewMembers.jTable1.getSelectedRow(), 7);
                    viewMembers.jTable1.setValueAt(moneyAccount, viewMembers.jTable1.getSelectedRow(), 8);
                    
                    Member memb=new Member(dni,name,surname,gmail,password,admin,moneyPay,moneyAccount,photo);
                    model.updateMember(memb);
                    JOptionPane.showMessageDialog(null, "Is change");
                    this.viewMembers.setVisible(false);
                    ViewMembers view1 = ViewMembers.viewaSortuBistaratu();
                    Model model1 = new Model();
                    MemberController controller1 = new MemberController (model1, view1);
                    break;

                } else {
                    if (viewMembers.jTable1.getRowCount() == 0) {
                        JOptionPane.showMessageDialog(null, "Table is empty");
                    } else {
                        JOptionPane.showMessageDialog(null, "You have to select a row");
                    }
                }
                break;
            case "Back":
                AdminMenu a1=new AdminMenu();
                a1.setVisible(true);
                this.viewMembers.setVisible(false);
                break;
        }
    }
 }
