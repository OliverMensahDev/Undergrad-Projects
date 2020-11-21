/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controllers;

/**
 *
 * @author oliver.mensah
 */
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.SQLException;
import javax.swing.JFrame;
import javax.swing.JOptionPane;
import views.*;
import models.Data;
public class CheckBalanceController implements ActionListener{

    CheckBalance balance;
    Data data;
    public CheckBalanceController(CheckBalance balance, Data data){
        this.balance = balance;
        this.data = data;  
 
    }
    public void CheckBalanceControllerMethod(){
        balance.getSearchButton().addActionListener(this);
        balance.getExitButton().addActionListener(this);
        balance.setExtendedState(JFrame.MAXIMIZED_BOTH); 
        balance.setVisible(true);
    }

    @Override
    public void actionPerformed(ActionEvent ae){
        //search for account number 
        
        if(ae.getSource()==balance.getSearchButton()){
            if("".equals(balance.getSearchID().getText().trim())){
                JOptionPane.showMessageDialog(null, "Account Number Cannot be Empty", "NO ACCOUN  NUMBER", 0);
            }
            if(isInteger(balance.getSearchID().getText().trim())==false){
                JOptionPane.showMessageDialog(null,"ACCOUNT NUMBER CANNOT BE LETTERS");
            }
            if(isInteger(balance.getSearchID().getText().trim())==true){
                
                try {
                    int accountNumber = Integer.parseInt(balance.getSearchID().getText().trim());
                    System.out.println(accountNumber);
                    String staffData [] = data.checkingForACcoutNumber(accountNumber);
                    if(staffData[0].equals(balance.getSearchID().getText().trim())){
                    balance.getContent().setText(
                            "Account Number: " + staffData[0]
                            +"\n"
                            +"\n"
                            +"Name : " + staffData[1] + " "+staffData[2]+ "  " +staffData[3]
                            +"\n"
                            +"\n"
                            +"Phone Number:  " +  staffData[4]
                            +"\n"
                            +"\n"
                            +"Your Current Balance: GH$" + staffData[5]               
                    );
                    } else        {
                    JOptionPane.showMessageDialog(null, "The Account number is invalid");
                }                               
                } catch (SQLException ex) {
                    JOptionPane.showMessageDialog(null, "The Account number is invalid");
                }                   
            }
        }
        
    if(ae.getSource()==balance.getExitButton()){
            balance.dispose();
            HomePage home = new HomePage();
            HomePageController cont = new HomePageController(home);
            cont.HomePageControllerMethod();
        }
    }
    
    public boolean isInteger( String input ) {
    try {
        Integer.parseInt( input );
        return true;
    }
    catch( Exception e ) {
        return false;
    }

}
}
