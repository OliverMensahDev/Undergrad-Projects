/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controllers;

/**
 *
 * @author oliver.mensah
 * 
 * */
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JFrame;
import models.Data;
import views.*;

public class HomePageController implements ActionListener {
    HomePage home  ;
    
    public HomePageController(HomePage home){
        this.home = home;
    }
    
    public void HomePageControllerMethod(){
        //Account
    
    home.getCreateAccount().addActionListener(this);
    home.getDeposit().addActionListener(this);
    home.getWithdraw().addActionListener(this);
    home.getCheckBalance().addActionListener(this);
    home.getViewClients().addActionListener(this);  
    home.getExit().addActionListener(this);
    home.setExtendedState(JFrame.MAXIMIZED_BOTH); 
    home.setVisible(true);
    
    }
    @Override
    public void actionPerformed(ActionEvent ae){
        //creating account
        if(ae.getSource()==home.getCreateAccount()){
            home.dispose();
            CreateAccount staff = new CreateAccount();
            Data data = new Data();
            CreateAccountController cont = new CreateAccountController(staff, data);
            cont.CreateAccountControllerMethod();           
        }
        //deposit 
        if(ae.getSource()== home.getDeposit()){
             home.dispose();
            Deposit deposit = new Deposit();
            Data data = new Data();
            DepositController cont = new DepositController(deposit, data);
            cont.DepositControllerMethod();
        }
        //withdraw
        if(ae.getSource()== home.getWithdraw()){
         home.dispose();
         WithDraw wd = new WithDraw();
         Data  db = new Data();
         WithDrawController cont = new WithDrawController(wd,db);
         cont.WithDrawControllerMethod();
        }
        //check balance
        if(ae.getSource()== home.getCheckBalance()){
         home.dispose();
         CheckBalance cb = new CheckBalance();
         Data  db = new Data();
         CheckBalanceController cont = new CheckBalanceController(cb,db);
         cont.CheckBalanceControllerMethod();
        }
        // viewcustomers
        if(ae.getSource()==home.getViewClients()){
            home.dispose();
            ViewCustomers vc = new ViewCustomers();
            Data data = new Data();
            ViewCustomerController cont;
            try {
                cont = new ViewCustomerController(vc, data);
                 cont.ViewCustomerControllerMethod();
            } catch (SQLException ex) {
                Logger.getLogger(HomePageController.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
        
        //close
        if(ae.getSource()== home.getExit()){
         home.dispose();
         LoginForm lg = new LoginForm();
         Data  db = new Data();
         LoginFormController cont = new LoginFormController(lg,db);
         cont.LoginControllerMethod();
        }
        
    }
    }
