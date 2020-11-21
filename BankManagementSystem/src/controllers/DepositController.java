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
import java.awt.Image;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;
import java.sql.SQLException;
import java.text.DateFormat;
import java.text.DecimalFormat;
import java.util.Date;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import javax.swing.ImageIcon;
import javax.swing.JFrame;
import javax.swing.JOptionPane;
import views.*;
import models.Data;
public class DepositController implements ActionListener{
    String userGlobalNumber;
    double userGlobalAmount;
    Deposit deposit;
    Data data;
    public DepositController(Deposit deposit, Data data){
        this.deposit = deposit;
        this.data = data;  
        Date now = new Date();
        DateFormat dfault = DateFormat.getDateInstance();
        deposit.getDate().setText(dfault.format(now));
        
    }
    public void DepositControllerMethod(){
        deposit.getSaveButton().addActionListener(this);
        deposit.getSearchButton().addActionListener(this);
        deposit.getExitButton().addActionListener(this);
        deposit.getReset().addActionListener(this);
        deposit.setExtendedState(JFrame.MAXIMIZED_BOTH); 
        deposit.setVisible(true);
        
        deposit.getDepositor().addItemListener(new ItemListener(){
            @Override
            public void itemStateChanged(ItemEvent event){
                Object item = event.getItem();
                if (event.getStateChange() == ItemEvent.SELECTED) {
                    if(item.toString().equals("SELF")){
                        System.out.println(item.toString());
                        deposit.getDepositorNumber().setEditable(false);                
                }if(item.toString().equals("OTHER")){
                        System.out.println(item.toString());
                        deposit.getDepositorNumber().setEditable(true);                
                }
                 
            }
                
        }  
    });
    }
    

    @Override
    public void actionPerformed(ActionEvent ae){
        //search for account number 
        
        if(ae.getSource()==deposit.getSearchButton()){
            if("".equals(deposit.getSearchID().getText().trim())){
                JOptionPane.showMessageDialog(null, "Account Number Cannot be Empty", "NO ACCOUNT  NUMBER", 0);
            }
            if(isInteger(deposit.getSearchID().getText().trim())==false){
                JOptionPane.showMessageDialog(null,"ACCOUNT NUMBER CANNOT BE LETTERS");
            }
            if(isInteger(deposit.getSearchID().getText().trim())==true){
                
                try {
                    int accountNumber = Integer.parseInt(deposit.getSearchID().getText().trim());
                    System.out.println(accountNumber);
                    String staffData [] = data.checkingForACcoutNumber(accountNumber);
                    deposit.getSearchID().setText(staffData[0]);
                    deposit.getFirstname().setText(staffData[1]);
                    deposit.getOthername().setText(staffData[2]);
                    deposit.getSurname().setText(staffData[3]);
                    userGlobalNumber = staffData[4];
                    userGlobalAmount = Double.parseDouble(staffData[5]);
                    byte[] image = data.getImage(accountNumber);
                    Image img = Toolkit.getDefaultToolkit().createImage(image);
                    ImageIcon icon =new ImageIcon(img);
                    deposit.getImage().setIcon(icon);
                    
                } catch (SQLException ex) {
                    JOptionPane.showMessageDialog(null, "The Account number is invalid");
                }                   
            }
        }
        if(ae.getSource()==deposit.getSaveButton()){
            if(
                    "".equals(deposit.getFirstname().getText().trim()) || 
                    "".equals(deposit.getSurname().getText().trim()) ||
                    "".equals(deposit.getOthername().getText().trim())
            ){
                JOptionPane.showMessageDialog(null, "The account number does not exit \n "
                        + "The client might be a new \n Create an account for the client");
            }
            else if(isDouble(deposit.getAmount().getText().trim())==false){
                JOptionPane.showMessageDialog(null, "Amount Should be of the format 80.00 instead of 80");
            }
            
            else{     
                    DecimalFormat df2 = new DecimalFormat(".##");
                    double input = Double.parseDouble(deposit.getAmount().getText().trim());
                    String cur = df2.format(input);
                    if("SELF".equals(String.valueOf(deposit.getDepositor().getSelectedItem()))){
                       try {
                           System.out.println(userGlobalNumber);
                        data.deposit(
                                Integer.parseInt(deposit.getSearchID().getText().trim()),
                                Double.parseDouble(deposit.getAmount().getText().trim()),
                                String.valueOf(deposit.getDepositor().getSelectedItem()),
                                deposit.getDate().getText().trim(),
                                userGlobalNumber
                        );
                        System.out.println(userGlobalAmount);
                         double curAmount = userGlobalAmount + Double.parseDouble(deposit.getAmount().getText().trim());
                         data.updateCurrentAmount(Integer.parseInt(deposit.getSearchID().getText().trim()),curAmount );
                         JOptionPane.showMessageDialog(null, "Thanks for the deposit. \n Your current Amount is GH$" + curAmount);
                         deposit.getSaveButton().setEnabled(false); 
                    } catch (SQLException ex) {
                        Logger.getLogger(DepositController.class.getName()).log(Level.SEVERE, null, ex);
                    }
                    }                    
                   
                    if("OTHER".equals(String.valueOf(deposit.getDepositor().getSelectedItem()))){
                        if("".equals(deposit.getDepositorNumber().getText().trim())){
                            JOptionPane.showMessageDialog(null, "Phone Number is the Depositor cant be empty");         
                        }
                        else if(isValidPhoneNo(deposit.getDepositorNumber().getText().trim())==false){
                            JOptionPane.showMessageDialog(null, "Phone Number must be of hte format 0544892841"); 
                        }
                        else{
                            try {
                        System.out.println("Depositor by other");
                        data.deposit(
                                Integer.parseInt(deposit.getSearchID().getText().trim()),
                                Double.parseDouble(deposit.getAmount().getText().trim()),
                                String.valueOf(deposit.getDepositor().getSelectedItem()),
                                deposit.getDate().getText().trim(),
                                deposit.getDepositorNumber().getText().trim()
                        );
                         double curAmount = userGlobalAmount + Double.parseDouble(deposit.getAmount().getText().trim());
                         data.updateCurrentAmount(Integer.parseInt(deposit.getSearchID().getText().trim()),curAmount );
                         JOptionPane.showMessageDialog(null, "Thanks for the deposit. \n Your current Amount is GH$" + curAmount);
                         deposit.getSaveButton().setEnabled(false); 
                    } catch (SQLException ex) {
                        Logger.getLogger(DepositController.class.getName()).log(Level.SEVERE, null, ex);
                    }
                        
                        
                    }
                }
                     if("--SELECT WHO DEPOSITED THE MONEY--".equals(String.valueOf(deposit.getDepositor().getSelectedItem()))){
                          JOptionPane.showMessageDialog(null, "select SELF if the deposited by client him/herself \n else select OTHER");
                     }
                 }
    }
    if(ae.getSource()==deposit.getExitButton()){
            deposit.dispose();
            HomePage home = new HomePage();
            HomePageController cont = new HomePageController(home);
            cont.HomePageControllerMethod();
        }
    if(ae.getSource()==deposit.getReset()){
        deposit.getSaveButton().setEnabled(true);
        deposit.getFirstname().setText("");
        deposit.getSurname().setText("");
        deposit.getOthername().setText("");
        deposit.getSearchID().setText("");
        deposit.getAmount().setText("");
        deposit.getDepositor().setSelectedItem("--SELECT WHO DEPOSITED THE MONEY--");
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
     public  boolean isValidPhoneNo(String phoneNo) {
         Pattern pattern = Pattern.compile("^[0]\\d{3}\\d{3}\\d{3}");
         Matcher matcher = pattern.matcher(phoneNo); 
         if (matcher.matches())
             return true;
         else
             return false;         
     }
    
 public boolean isDouble( String input) {
    try {
        Double.parseDouble( input );
        return true;
    }
    catch( Exception e ) {
        return false;
    }
}
}
