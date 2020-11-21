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
import java.awt.HeadlessException;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.SQLException;
import javax.swing.JFrame;
import javax.swing.JOptionPane;
import views.*;
import models.*;

public class LoginFormController implements ActionListener {
   LoginForm login;
   Data data;
   
   public LoginFormController(LoginForm login , Data data){
       this.login = login;
       this.data = data;
   }
   
   public void LoginControllerMethod(){
       login.getLogin().addActionListener(this);
       login.getExit().addActionListener(this);
       login.setExtendedState(JFrame.MAXIMIZED_BOTH); 
       login.setVisible(true);
   }
   @Override
   public void actionPerformed(ActionEvent ae){
       if(ae.getSource()==login.getLogin()){
            if("".equals(login.getUserName().getText()) || "".equals(login.getPassWord().getText())){
            JOptionPane.showMessageDialog(null, "Empty User  Input");
        } else try {
            
           if(login.getUserName().getText().trim().equals(data.getUserName()) && login.getPassWord().getText().trim().equals(data.getUserPass())){
               HomePage home = new HomePage();
               HomePageController cont = new HomePageController(home);
               JOptionPane.showMessageDialog(null, "Successfully logged in");
               cont.HomePageControllerMethod();
               login.setVisible(false);
            }
           else{
                JOptionPane.showMessageDialog(null, "Unmatched User Data");
            }
        } catch (SQLException | HeadlessException ex) {
            System.out.println(ex.getMessage());
            
        }
    }           
       if(ae.getSource() == login.getExit()){
           login.dispose();
       }
   
   }
}
