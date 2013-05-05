<%-- 
    Document   : editProfile
    Created on : Apr 13, 2013, 11:32:13 AM
    Author     : Sigit Aji Nugroho
--%>

<%@ page import ="java.sql.*" %>
<%@ page import ="javax.sql.*" %>        
<%  //-------------------------register---------------------------------
    
    String pwdReg = request.getParameter("cp");
    String namaReg = request.getParameter("fn");
    String tglReg = request.getParameter("bd");
    
    Class.forName("com.mysql.jdbc.Driver");
    java.sql.Connection conLogin2 = DriverManager.getConnection("jdbc:mysql://localhost:3306/progin_405_13510003","root","");
    
    Statement stLogin2= conLogin2.createStatement();
    if(pwdReg==null){
        int rsLogin2=stLogin2.executeUpdate("UPDATE pengguna SET nama_lengkap="+request.getParameter("fn")+",tanggal_lahir="+request.getParameter("bd")+" WHERE username='"+request.getParameter("user")+"'"); 
    
    }else{
        int rsLogin2=stLogin2.executeUpdate("UPDATE pengguna SET nama_lengkap="+request.getParameter("fn")+",tanggal_lahir="+request.getParameter("bd")+",password="+request.getParameter("cp")+" WHERE username='"+session.getAttribute("userLoginSession")+"'"); 
    }
    response.sendRedirect("profile.jsp");
%> 
