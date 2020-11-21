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
import views.WithDraw;
import models.Data;
import views.HomePage;
public class WithDrawController implements ActionListener{
    String userGlobalNumber;
    double userGlobalAmount;
    WithDraw withdraw;
    Data data;
    public WithDrawController(WithDraw withdraw, Data data){
        this.withdraw = withdraw;
        this.data = data;  
        Date now = new Date();
        DateFormat dfault = DateFormat.getDateInstance();
        withdraw.getDate().setText(dfault.format(now));
        
    }
    public void WithDrawControllerMethod(){
        withdraw.getSaveButton().addActionListener(this);
        withdraw.getSearchButton().addActionListener(this);
        withdraw.getExitButton().addActionListener(this);
        withdraw.getReset().addActionListener(this);
        withdraw.setExtendedState(JFrame.MAXIMIZED_BOTH); 
        withdraw.setVisible(true);
        
        withdraw.getWithDrawal().addItemListener(new ItemListener(){
            @Override
            public void itemStateChanged(ItemEvent event){
                Object item = event.getItem();
                if (event.getStateChange() == ItemEvent.SELECTED) {
                    if(item.toString().equals("SELF")){
                        System.out.println(item.toString());
                        withdraw.getWithDrawalNumber().setEditable(false);                
                }if(item.toString().equals("OTHER")){
                        System.out.println(item.toString());
                        withdraw.getWithDrawalNumber().setEditable(true);                
                }
                 
            }
                
        }  
    });
    }
    

    @Override
    public void actionPerformed(ActionEvent ae){
        //search for account number 
        
        if(ae.getSource()==withdraw.getSearchButton()){
            if("".equals(withdraw.getSearchID().getText().trim())){
                JOptionPane.showMessageDialog(null, "Account Number Cannot be Empty", "NO ACCOUNT  NUMBER", 0);
            }
            if(isInteger(withdraw.getSearchID().getText().trim())==false){
                JOptionPane.showMessageDialog(null,"ACCOUNT NUMBER CANNOT BE LETTERS");
            }
            if(isInteger(withdraw.getSearchID().getText().trim())==true){
                
                try {
                    int accountNumber = Integer.parseInt(withdraw.getSearchID().getText().trim());
                    System.out.println(accountNumber);
                    String staffData [] = data.checkingForACcoutNumber(accountNumber);
                    withdraw.getSearchID().setText(staffData[0]);
                    withdraw.getFirstname().setText(staffData[1]);
                    withdraw.getOthername().setText(staffData[2]);
                    withdraw.getSurname().setText(staffData[3]);
                    userGlobalNumber = staffData[4];
                    userGlobalAmount = Double.parseDouble(staffData[5]);
                    byte[] image = data.getImage(accountNumber);
                    Image img = Toolkit.getDefaultToolkit().createImage(image);
                    ImageIcon icon =new ImageIcon(img);
                    withdraw.getImage().setIcon(icon);
                    
                } catch (SQLException ex) {
                    JOptionPane.showMessageDialog(null, "The Account number is invalid");
                }                   
            }
        }
        if(ae.getSource()==withdraw.getSaveButton()){
            if(
                    "".equals(withdraw.getFirstname().getText().trim()) || 
                    "".equals(withdraw.getSurname().getText().trim()) ||
                    "".equals(withdraw.getOthername().getText().trim())
            ){
                JOptionPane.showMessageDialog(null, "The account number does not exit \n "
                        + "The client might be a new \n Create an account for the client");
            }
            else if(isDouble(withdraw.getAmount().getText().trim())==false){
                JOptionPane.showMessageDialog(null, "Amount Should be of the format 80.00 instead of 80");
            }
            
            else{     
                    DecimalFormat df2 = new DecimalFormat(".##");
                    double input = Double.parseDouble(withdraw.getAmount().getText().trim());
                    String cur = df2.format(input);
                    if("SELF".equals(String.valueOf(withdraw.getWithDrawal().getSelectedItem()))){
                       try {
                           System.out.println(userGlobalNumber);
                        data.withdraw(
                                Integer.parseInt(withdraw.getSearchID().getText().trim()),
                                Double.parseDouble(withdraw.getAmount().getText().trim()),
                                String.valueOf(withdraw.getWithDrawal().getSelectedItem()),
                                withdraw.getDate().getText().trim(),
                                userGlobalNumber
                        );
                        System.out.println(userGlobalAmount);
                         double curAmount = userGlobalAmount - Double.parseDouble(withdraw.getAmount().getText().trim());
                        if(curAmount > 0){
                         data.updateCurrentAmount(Integer.parseInt(withdraw.getSearchID().getText().trim()),curAmount );
                         JOptionPane.showMessageDialog(null, "Thanks banking with us. \n Your current Amount is GH$" + curAmount);
                         withdraw.getSaveButton().setEnabled(false); 
                        }else{
                            JOptionPane.showMessageDialog(null, "Thanks banking with us. \n Your current Amount is GH$" + userGlobalAmount 
                                    +"\n Meaning you cannot withdraw more than this amount");
                        }
                    } catch (SQLException ex) {
                        Logger.getLogger(WithDrawController.class.getName()).log(Level.SEVERE, null, ex);
                    }
                    }                    
                   
                    if("OTHER".equals(String.valueOf(withdraw.getWithDrawal().getSelectedItem()))){
                        if("".equals(withdraw.getWithDrawalNumber().getText().trim())){
                            JOptionPane.showMessageDialog(null, "Phone Number cant be empty");         
                        }
                        else if(isValidPhoneNo(withdraw.getWithDrawalNumber().getText().trim())==false){
                            JOptionPane.showMessageDialog(null, "Phone Number must be of hte format 0544892841"); 
                        }
                        else{
                            try {
                        System.out.println("withdraw by other");
                        data.withdraw(
                                Integer.parseInt(withdraw.getSearchID().getText().trim()),
                                Double.parseDouble(withdraw.getAmount().getText().trim()),
                                String.valueOf(withdraw.getWithDrawal().getSelectedItem()),
                                withdraw.getDate().getText().trim(),
                                withdraw.getWithDrawalNumber().getText().trim()
                        );
                        double curAmount = userGlobalAmount - Double.parseDouble(withdraw.getAmount().getText().trim());
                        if(curAmount > 0){
                         data.updateCurrentAmount(Integer.parseInt(withdraw.getSearchID().getText().trim()),curAmount );
                         JOptionPane.showMessageDialog(null, "Thanks banking with us. \n Your current Amount is GH$" + curAmount);
                         withdraw.getSaveButton().setEnabled(false); 
                        }else{
                            JOptionPane.showMessageDialog(null, "Thanks banking with us. \n Your current Amount is GH$" + userGlobalAmount
                                    +"\n Meaning you cannot withdraw more than this amount");
                        }
                    } catch (SQLException ex) {
                        Logger.getLogger(WithDrawController.class.getName()).log(Level.SEVERE, null, ex);
                    }
                        
                        
                    }
               }
                    if("--SELECT WHO WITHDREW THE MONEY--".equals(String.valueOf(withdraw.getWithDrawal().getSelectedItem()))){
                          JOptionPane.showMessageDialog(null, "select SELF if the withdrew by client him/herself \n else select OTHER");
                     }    
            }
        
    }
    if(ae.getSource()==withdraw.getExitButton()){
            withdraw.dispose();
            HomePage home = new HomePage();
            HomePageController cont = new HomePageController(home);
            cont.HomePageControllerMethod();
        }
    if(ae.getSource()==withdraw.getReset()){
        withdraw.getSaveButton().setEnabled(true);
        withdraw.getFirstname().setText("");
        withdraw.getSurname().setText("");
        withdraw.getOthername().setText("");
        withdraw.getSearchID().setText("");
        withdraw.getAmount().setText("");
        withdraw.getWithDrawal().setSelectedItem("--SELECT WHO WITHDREW THE MONEY--");
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
