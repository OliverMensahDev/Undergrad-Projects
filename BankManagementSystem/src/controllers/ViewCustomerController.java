/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package controllers;

/**
 *
 * @author Peter
 */
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.SQLException;
import javax.swing.JFrame;
import views.ViewCustomers;
import views.HomePage;
import models.Data;
import views.deleteClient;

public class ViewCustomerController implements ActionListener{
    ViewCustomers viewcustomer;
    HomePage home;
    Data data;
    public ViewCustomerController(ViewCustomers viewcustomer, Data data){
        this.viewcustomer = viewcustomer;
        this.data = data;  
    }
    
    public void ViewCustomerControllerMethod() throws SQLException{
        viewcustomer.getExit().addActionListener(this);
        viewcustomer.getDelete().addActionListener(this);
        data.FillTable(viewcustomer.getCustomerTable(), data.getQuery());
        viewcustomer.setExtendedState(JFrame.MAXIMIZED_BOTH); 
        viewcustomer.setVisible(true);
    }
    @Override
    public void actionPerformed(ActionEvent ae){
        if(ae.getSource()== viewcustomer.getExit()){
            viewcustomer.dispose();
            HomePage home = new HomePage();
            HomePageController cont = new HomePageController(home);
            cont.HomePageControllerMethod();
        }
        if(ae.getSource()==viewcustomer.getDelete()){
            deleteClient del = new deleteClient();
            Data db = new Data();
            deleteController cont = new deleteController(del, db);
            cont.method();
            
        }
        
    }
    
}
