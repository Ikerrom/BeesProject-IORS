/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controller;

import ejecutes.AdminMenu;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.time.LocalDate;
import java.time.LocalDateTime;
import javax.swing.JOptionPane;
import model.Model;
import model.Reserve;

/**
 *
 * @author inazi
 */
public class ReservesController implements ActionListener {
    /**
     * Private atributes
     */
    private Model model;
    private ViewReserves viewReserves;
    /**
     * Constructor
     * @param model Model
     * @param viewReserves  ViewReserves
     */
    public ReservesController(Model model, ViewReserves viewReserves) {
        this.model = model;
        this.viewReserves = viewReserves;
        anadirActionListener(this);
        
    }    
    /**
     * Called just after the user performs an action.
     * @param listener 
     */
    private void anadirActionListener(ActionListener listener) {
        viewReserves.jButton1.addActionListener(listener);
        viewReserves.jButton3.addActionListener(listener);
        viewReserves.jButton4.addActionListener(listener);
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
                    String dni = viewReserves.jComboBox1.getSelectedItem().toString();
                    String dia_reservado = (String)(viewReserves.jTextField3.getText());
                    int lata = Integer.valueOf(viewReserves.jComboBox2.getSelectedItem().toString()); 
                    String dia_dereserva =(String)viewReserves.jTextField4.getText();
                    Reserve r=new Reserve(dni,dia_reservado,lata,dia_dereserva);
                    model.addReserve(r);
                    this.viewReserves.setVisible(false);
                    ViewReserves view2 = ViewReserves.viewaSortuBistaratu();
                    Model model2 = new Model();
                    ReservesController controller = new ReservesController (model2, view2);
                    break; 
                }catch(NumberFormatException n){
                    JOptionPane.showMessageDialog(null,n.getMessage());
                    break;
                }
                
            case "Delete":
                String dni1= (String) viewReserves.jTable1.getValueAt(viewReserves.jTable1.getSelectedRow(), 0);
                LocalDate day_reserved1=(LocalDate)  viewReserves.jTable1.getValueAt(viewReserves.jTable1.getSelectedRow(), 1);
                int lata1=(int) viewReserves.jTable1.getValueAt(viewReserves.jTable1.getSelectedRow(), 2);
                LocalDateTime day_reservation1= (LocalDateTime)viewReserves.jTable1.getValueAt(viewReserves.jTable1.getSelectedRow(), 3);
                if(viewReserves.jTable1.getSelectedRow()!=-1){
                    Reserve r1=new Reserve(dni1,String.valueOf(day_reserved1),lata1,String.valueOf(day_reservation1));
                    model.deleteReserve(r1);
                    this.viewReserves.setVisible(false);
                    ViewReserves view1 = ViewReserves.viewaSortuBistaratu();
                    Model model1 = new Model();
                    ReservesController controller1 = new ReservesController (model1, view1);
                    break;
                }else{
                    JOptionPane.showMessageDialog(null,"You have to seelct row");
                }
                break;
            case "Back":
                AdminMenu a1=new AdminMenu();
                a1.setVisible(true);
                this.viewReserves.setVisible(false);
                break;       
        }
    }
}
