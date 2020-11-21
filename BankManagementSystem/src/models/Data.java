/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package models;

/**
 *
 * @author oliver.mensah
 */
import java.io.FileInputStream;
import java.sql.*;
import javax.swing.JOptionPane;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

public class Data {
     //connection strings
    public static final String DRIVER =  "com.mysql.jdbc.Driver";
    public static final String URL = "jdbc:mysql://localhost/bank";
    static final String USER = "root";
    static final String PASS = "";
    
    String staffData [] ;
   /**
    * get connection
    * @return 
    */
   public Connection getConnection(){ 
       Connection conn = null;
       try {
           Class.forName(DRIVER);
       } catch (ClassNotFoundException e) {
            System.out.println(e.getMessage());
       }
       try{
           Class.forName(DRIVER).newInstance();
           conn = java.sql.DriverManager.getConnection(URL,USER,PASS);
           if(conn != null){
               System.out.println("Successful Connection was made");
           }
        }catch(ClassNotFoundException | InstantiationException | IllegalAccessException | SQLException ex){
            JOptionPane.showMessageDialog(null, "Xampp might not be started \n Please start xampp and make sure both apache and mysql are running");
        }  
       return conn;
       }
   /**
    * get username
    * @return
    * @throws SQLException 
    */
      public String getUserName() throws SQLException{
          Connection conn = null;
          PreparedStatement s = null;
          String name =null;
          try{
          conn = getConnection();
          s = conn.prepareStatement("SELECT username FROM users");
          java.sql.ResultSet r = s.executeQuery("SELECT  username FROM users");
          while(r.next()){
              name = r.getString("username");
          }
          } catch (SQLException e) {
              System.out.println(e.getMessage());
              } finally {
              	if (s != null) {
                    s.close();
                    }
                if(conn != null){
                  conn.close();
		}

		}
          System.out.println(name);
          return name;
      }
      /**
       * get user password
       * @return
       * @throws SQLException 
       */
       public String getUserPass() throws SQLException{
          Connection conn = null;
          PreparedStatement s = null;
          String password =null;
          try{
          conn = getConnection();
                     
          s = conn.prepareStatement("SELECT  password FROM users");
          java.sql.ResultSet r = s.executeQuery("SELECT  password FROM users");
          while(r.next()){
              password = r.getString("password");
          }
          } catch (SQLException e) {
              System.out.println(e.getMessage());
              } finally {
              	if (s != null) {
                    s.close();
                    }
                if(conn != null){
                  conn.close();
		}

		}
          System.out.println(password);
          return password;
      }
       /**
        * create accoount
        * @param accountNumber
        * @param firstname
        * @param othername
        * @param surname
        * @param phoneNumber
        * @param accountType
        * @param currentAmount
        * @param dateCraeted
        * @throws SQLException 
        */
       public void createAccount( int accountNumber, String firstname,   String othername, String surname,  String phoneNumber, String accountType,  double currentAmount, String dateCraeted, FileInputStream fin, int len) throws SQLException{
           Connection conn = null;
           PreparedStatement p = null;
           String query = "INSERT INTO account"
                   +"(accountNumber,firstname,othername,surname,phoneNumber,accountType,currentAmount,dateCreated, Image) VALUES"
                   +"(?,?,?,?,?,?,?,?,?)";
           try{
               conn= getConnection();
               p = conn.prepareStatement(query);
               p.setInt(1, accountNumber);
               p.setString(2, firstname);
               p.setString(3, othername);
               p.setString(4, surname);
               p.setString(5, phoneNumber);
               p.setString(6, accountType);
               p.setDouble(7, currentAmount);
               p.setString(8, dateCraeted);
               p.setBinaryStream(9,fin,len);
               //execute insert SQL insert statement
               p.executeUpdate();
               JOptionPane.showMessageDialog(null,"thanks for adding extra data");
           }catch(SQLException e){
                JOptionPane.showMessageDialog(null,"Account has been creaated for this kind of user");
           }finally{
           if(p != null)
               p.close();
           if(conn !=null)
               conn.close();
           }          
         
       }
       /**
        * deposit method
        * @param accountNumber
        * @param amount
        * @param depositor
        * @param dateCraeted
     * @param depostitorNumber
        * @throws SQLException 
        */
        public void deposit(int accountNumber,double amount,  String depositor, String dateCraeted, String depostitorNumber) throws SQLException{
               Connection conn = null;
               PreparedStatement p = null;
               String query = "INSERT INTO deposit"
                   +"(accountNumber,amount,depositor, deposit_date, depositorNumber) VALUES"
                   +"(?,?,?,?,?)";
           try{
               conn= getConnection();
               p = conn.prepareStatement(query);
               p.setInt(1, accountNumber);
               p.setDouble(2,amount);
               p.setString(3, depositor);
               p.setString(4, dateCraeted);
               p.setString(5,depostitorNumber);
               //execute insert SQL insert statement
               p.executeUpdate();
           }catch(SQLException e){
                JOptionPane.showMessageDialog(null,e.getMessage());
           }finally{
           if(p != null)
               p.close();
           if(conn !=null)
               conn.close();
           }          
       }

    /**
     *
     * @param accountNumber
     * @param amount
     * @param withdrawal
     * @param withdraw_date
     * @param withdrawalNumber
     * @throws SQLException
     */
    public void withdraw(int accountNumber,double amount,  String withdrawal, String withdraw_date, String withdrawalNumber) throws SQLException{
               Connection conn = null;
               PreparedStatement p = null;
               String query = "INSERT INTO withdraw"
                   +"(accountNumber,amount,withdrawal, withdraw_date, withdrawalNumber) VALUES"
                   +"(?,?,?,?,?)";
           try{
               conn= getConnection();
               p = conn.prepareStatement(query);
               p.setInt(1, accountNumber);
               p.setDouble(2,amount);
               p.setString(3, withdrawal);
               p.setString(4, withdraw_date);
               p.setString(5,withdrawalNumber);
               //execute insert SQL insert statement
               p.executeUpdate();
           }catch(SQLException e){
                JOptionPane.showMessageDialog(null,e.getMessage());
           }finally{
           if(p != null)
               p.close();
           if(conn !=null)
               conn.close();
           }          
       }
        /**
         * update current ammount
         * @param accountNumber
         * @param amount
         * @throws SQLException 
         */
          public void updateCurrentAmount(int accountNumber, double amount)throws SQLException{
          Connection conn = null;
          PreparedStatement p = null;
          String query = "UPDATE account SET currentAmount = ? WHERE accountNumber= ?";
          try {
              conn = getConnection();
              p = conn.prepareStatement(query);
             
              p.setDouble(1, amount);
               p.setInt(2, accountNumber);
              p.executeUpdate();
           }catch(SQLException e){
                JOptionPane.showMessageDialog(null,e.getMessage());
           } finally{
               if(p !=null){
                   p.close();
               }
               if(conn != null){
                   conn.close();
               }
           }
      }
          /**
           * checking or searching for account number
           * @param id
           * @return
           * @throws SQLException 
           */
       public String[] checkingForACcoutNumber(int id) throws SQLException{
           Connection conn = null;
           PreparedStatement p = null;
           String query = "SELECT * FROM account WHERE accountNumber= ?";
           staffData = new String[6]; 
           try{
               conn = getConnection();
               p = conn.prepareStatement(query);
               p.setInt(1, id);
               ResultSet rs =  p.executeQuery();
               while(rs.next()){
                    staffData[0] = String.valueOf(rs.getInt("accountNumber"));
                    staffData[1] = rs.getString("firstname");
                    staffData[2] = rs.getString("othername");
                    staffData[3] = rs.getString("surname");
                    staffData[4] = rs.getString("phoneNumber");
                    staffData[5] = rs.getString("currentAmount");
               }
           }catch(SQLException ex){
                       JOptionPane.showMessageDialog(null,  ex.getMessage());
           }finally{
               if(p !=null){
                   p.close();
               }
               if(conn != null){
                   conn.close();
               }
           } 
           return staffData;
       }
       public boolean searchID(int id) throws SQLException{
           Connection conn = null;
           PreparedStatement p = null;
           String query = "SELECT * FROM account WHERE accountNumber= ?";
           boolean bool = false;
           try{
               conn = getConnection();
               p = conn.prepareStatement(query);
               p.setInt(1, id);
               ResultSet rs =  p.executeQuery();
               System.out.println(rs.getFetchSize()); 
              if(rs.getFetchSize()>=1){
                  bool = true;
              
                  return bool;
              }else{
                  bool = false;
                  return bool;
              }
           }catch(SQLException ex){
                       JOptionPane.showMessageDialog(null,  ex.getMessage());
           }finally{
               if(p !=null){
                   p.close();
               }
               if(conn != null){
                   conn.close();
               }
           } 
           System.out.print(bool);
           return bool;
       }
       
       public byte[] getImage(int id) throws SQLException{
           Connection conn = null;
           PreparedStatement p = null;
           String query = "SELECT image FROM account WHERE accountNumber= ?";
           byte[] image = null;
           try{
               conn = getConnection();
               p = conn.prepareStatement(query);
               p.setInt(1, id);
               ResultSet rs =  p.executeQuery();
               
               while(rs.next()){
                    image = rs.getBytes("image");
               }
           }catch(Exception e){}
           
            
          return image;  
       }
             
       
       public String getQuery(){
           String query = "SELECT * FROM account ";
           return query;
       }
          
           
 public void FillTable(JTable table, String query) throws SQLException{
       Connection conn = null;
       PreparedStatement p = null;
       ResultSet rs = null;
       try{
            conn = getConnection();
            p = conn.prepareStatement(query);
            rs=  p.executeQuery();

        //To remove previously added rows
        while(table.getRowCount() > 0) 
        {
            ((DefaultTableModel) table.getModel()).removeRow(0);
        }
        int columns = rs.getMetaData().getColumnCount();
        while(rs.next())
        {  
            Object[] row = new Object[columns];
            for (int i = 1; i <= columns; i++)
            {  
                row[i - 1] = rs.getObject(i);
            }
            ((DefaultTableModel) table.getModel()).insertRow(rs.getRow()-1,row);
        }

        rs.close();
        
    } catch(SQLException e)
    {
    }
    finally{
               if(p !=null){
                   p.close();
               }
               if(conn != null){
                   conn.close();
               }
           } 
 }
      public void updateRecord(int id, String fname, String oname, String sname,String gender, String date_birth,
                               String date_appointed,  String department, String position) throws SQLException{
          Connection conn = null;
          PreparedStatement p = null;
          String query = "UPDATE staff SET firstname = ?, othername=? ,  surname=? ,  gender=?, date_of_birth=?, date_appointed=? , department=?,  position=? WHERE staff_id = ?";
          try {
              conn = getConnection();
              p = conn.prepareStatement(query);
             
              p.setString(1, fname);
              p.setString(2, oname);
              p.setString(3, sname);
              p.setString(4, gender);
              p.setString(5,date_birth);
              p.setString(6, date_appointed);
              p.setString(7, department);
              p.setString(8, position);
               p.setInt(9, id);
              p.executeUpdate();
              JOptionPane.showMessageDialog(null,"Thanks for making ");
           }catch(SQLException e){
                JOptionPane.showMessageDialog(null,e.getMessage());
           } finally{
               if(p !=null){
                   p.close();
               }
               if(conn != null){
                   conn.close();
               }
           }
      }
      public void delete(int id) throws SQLException{
      Connection conn =null;
      PreparedStatement p = null;
      try{
          conn = getConnection();
          String query = "DELETE FROM account WHERE accountNumber =?";
          p = conn.prepareStatement(query);
          p.setInt(1,id);
          p.executeUpdate();
          }catch(SQLException ex){
             JOptionPane.showMessageDialog(null, ex.getMessage());
         } finally{
          if(p != null){
              p.close();
          }
          if(conn != null){
              conn.close();
          }
      }
      }
      public void deletewith(int id) throws SQLException{
      Connection conn =null;
      PreparedStatement p = null;
      try{
          conn = getConnection();
          String query = "DELETE FROM withdraw WHERE accountNumber =?";
          p = conn.prepareStatement(query);
          p.setInt(1,id);
          p.executeUpdate();
          }catch(SQLException ex){
             JOptionPane.showMessageDialog(null, ex.getMessage());
         } finally{
          if(p != null){
              p.close();
          }
          if(conn != null){
              conn.close();
          }
      }
      }
      public void deleteDep(int id) throws SQLException{
      Connection conn =null;
      PreparedStatement p = null;
      try{
          conn = getConnection();
          String query = "DELETE FROM deposit WHERE accountNumber =?";
          p = conn.prepareStatement(query);
          p.setInt(1,id);
          p.executeUpdate();
          }catch(SQLException ex){
             JOptionPane.showMessageDialog(null, ex.getMessage());
         } finally{
          if(p != null){
              p.close();
          }
          if(conn != null){
              conn.close();
          }
      }
      
   
      }
}
