/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controllers;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JOptionPane;
import models.Data;
import views.*;
/**
 *
 * @author Peter
 */
public class deleteController  implements ActionListener{
    deleteClient del;
    Data data;
    public deleteController(deleteClient del, Data data){
       this.del = del;
       this.data= data;
    }
    public void method(){
        del.getDelete().addActionListener(this);
        del.getClose().addActionListener(this);
        del.setVisible(true);
    }
    @Override
    public void actionPerformed(ActionEvent ae){
        if(ae.getSource()==del.getDelete()){
            if(isInteger(del.getAc().getText().trim())){
                int id = Integer.parseInt(del.getAc().getText().trim());
                try {
                    data.delete(id);
                    data.deleteDep(id);
                    data.deletewith(id);
                    JOptionPane.showMessageDialog(null, " A client with acount number " + id +" was deleted");
                    ViewCustomers cust  = new ViewCustomers();
                    cust.dispose();
                    ViewCustomerController cont = new ViewCustomerController(cust, data);
                    cont.ViewCustomerControllerMethod();
                    
                } catch (SQLException ex) {
                    Logger.getLogger(deleteController.class.getName()).log(Level.SEVERE, null, ex);
                }
            }else{
                JOptionPane.showMessageDialog(null, "Account Number must be numbers");
            }
        }
        if(ae.getSource()==del.getClose()){
            del.dispose();
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
