/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 *
 * @author oliver.mensah
 */
import views.LoginForm;
import controllers.LoginFormController;
import models.Data;
public class BankManagementSystem {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        LoginForm login = new LoginForm();
        Data data = new Data();
        LoginFormController cont =  new LoginFormController( login,data);
        cont.LoginControllerMethod();
    }
    
}
