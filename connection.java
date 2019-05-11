import java.sql.*;


public class connection {
    private static Statement statement = null;
    private static Connection conn = null;

    public static void main(String[] args) {

        String connectionUrl =
                "jdbc:mysql://localhost/cs353";

        try {
            Class.forName("com.mysql.jdbc.Driver").newInstance();
            conn = DriverManager.getConnection(connectionUrl, "root", "root");
            System.out.println("Connected!!");
            statement = conn.createStatement();
            createTables();
            addEntries();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
    private static void addEntries() throws SQLException{
        statement.executeUpdate("insert into general_user values(1,\"tam35@mail.com\",\"1234\",\"3535353535\",DEFAULT,\"http://img7.bdbphotos.com/images/huge/w/d/wdd4fqg0265zzg60.jpg?djet1p5k\");");
        statement.executeUpdate("insert into work_user values(1,\"Robert Plant\", \"Musician\", \"Led Zeppelin\", \"Jumping\",\"loy Apt\",\"moy Sokak\",\"Goztepe\",\"Izmir\",\"Turkey\",35121);");
        statement.executeUpdate("insert into general_user values(2,\"50cent@mail.com\",\"1234\",\"353523515\",DEFAULT,\"https://static.hiphopdx.com/2017/11/171128-G-Unit-Getty-Images-800x600.jpg\");");
        statement.executeUpdate("insert into comp_user values(2,\"G-Unit\", \"RAPPER\");");
        statement.executeUpdate("insert into location values(2,\"gangsta Apt\",\"palmiye Sokak\",\"balcova\",\"Izmir\",\"Turkey\",16241,1);");
        statement.executeUpdate("insert into location values(2,\"tren Apt\",\"lider Sokak\",\"yoa chi\",\"tokyo\",\"Japon\",12451,0);");

    }
    private static void createTables() throws SQLException {

        statement.executeUpdate("drop table if exists checks;");
        statement.executeUpdate("drop table if exists admin;");
        statement.executeUpdate("drop table if exists submits;");
        statement.executeUpdate("drop table if exists has;");
        statement.executeUpdate("drop table if exists report;");
        statement.executeUpdate("drop table if exists gets;");
        statement.executeUpdate("drop table if exists leaves;");
        statement.executeUpdate("drop table if exists review;");
        statement.executeUpdate("drop table if exists applies;");
        statement.executeUpdate("drop table if exists does;");
        statement.executeUpdate("drop table if exists has_test;");
        statement.executeUpdate("drop table if exists application_test;");
        statement.executeUpdate("drop table if exists posts;");
        statement.executeUpdate("drop table if exists job_offering;");
        statement.executeUpdate("drop table if exists location;");
        statement.executeUpdate("drop table if exists has_pic;");
        statement.executeUpdate("drop table if exists picture;");
        statement.executeUpdate("drop table if exists follows;");
        statement.executeUpdate("drop table if exists comp_user;");
        statement.executeUpdate("drop table if exists work_user;");
        statement.executeUpdate("drop table if exists general_user;");

        statement.executeUpdate("CREATE TABLE general_user(" +
                "user_ID INT AUTO_INCREMENT, " +
                "email VARCHAR(32) NOT NULL UNIQUE, " +
                "password VARCHAR(32) NOT NULL, " +
                "phone_no VARCHAR(32) NOT NULL UNIQUE," +
                "reg_date DATETIME DEFAULT CURRENT_TIMESTAMP, " +
                "pp_link VARCHAR(128) DEFAULT NULL," +
                "PRIMARY KEY(user_ID)" +
                ")engine=InnoDB;"
        );

        statement.executeUpdate("CREATE TABLE comp_user(" +
                "user_ID INT," +
                "FOREIGN KEY(user_ID) REFERENCES general_user(user_ID)\n " +
                "ON DELETE CASCADE," +
                "company_name VARCHAR(32) NOT NULL UNIQUE," +
                "description VARCHAR(128) DEFAULT NULL," +
                "primary key (user_ID)" +
                ")engine=InnoDB;"
        );
        statement.executeUpdate("CREATE TABLE work_user(" +
                "user_ID INT," +
                "FOREIGN KEY(user_ID) REFERENCES general_user(user_ID)\n" +
                "ON DELETE CASCADE," +
                "name VARCHAR(32) NOT NULL," +
                "background_info VARCHAR(128) DEFAULT NULL," +
                "experience VARCHAR(128) DEFAULT NULL," +
                "saved_interests VARCHAR(128) DEFAULT NULL," +
                "apartment_no VARCHAR(32) DEFAULT NULL," +
                "street VARCHAR(32) DEFAULT NULL," +
                "city VARCHAR(32) DEFAULT NULL," +
                "state VARCHAR(32) DEFAULT NULL," +
                "country VARCHAR(32) DEFAULT NULL,"+
                "zipcode VARCHAR(32) DEFAULT NULL,"+
                "primary key (user_ID)" +
                ")engine=InnoDB;"
        );
        statement.executeUpdate("CREATE TABLE location(" +
                "comp_ID INT," +
                "apartment_no VARCHAR(32) DEFAULT NULL," +
                "street VARCHAR(32) DEFAULT NULL," +
                "city VARCHAR(32) DEFAULT NULL," +
                "state VARCHAR(32) DEFAULT NULL," +
                "country VARCHAR(32) DEFAULT NULL,"+
                "zipcode VARCHAR(32) DEFAULT NULL," +
                "mainLocation TINYINT DEFAULT NULL," +
                "primary key( apartment_no, street, city, state, country, zipcode )"+
                ")engine=InnoDB;"
        );

        statement.executeUpdate("CREATE TABLE follows(" +
                "c_id INT," +
                "FOREIGN KEY(c_id) REFERENCES Comp_user(user_ID) \n" +
                "ON DELETE CASCADE," +
                "w_id INT," +
                "FOREIGN KEY(w_id) REFERENCES Work_user(user_ID) \n" +
                "ON DELETE CASCADE," +
                "PRIMARY KEY (c_id,w_id)" +
                ")engine=InnoDB;"
        );
        statement.executeUpdate("CREATE TABLE picture(" +
                "user_ID INT ," +
                "FOREIGN KEY(user_ID) REFERENCES work_user(user_ID)\n" +
                "ON DELETE CASCADE," +
                "link VARCHAR(32) NOT NULL, " +
                "date DATETIME DEFAULT CURRENT_TIMESTAMP," +
                "description VARCHAR(128) DEFAULT NULL," +
                "PRIMARY KEY (user_ID, link)" +
                ")engine=InnoDB;"
        );
        statement.executeUpdate("CREATE TABLE review(" +
                "review_id INT AUTO_INCREMENT," +
                "anonymity TINYINT(1) NOT NULL," +
                "type VARCHAR(32) NOT NULL," +
                "review_text VARCHAR(128) NOT NULL," +
                "comp_rating INT DEFAULT NULL," +
                "ceo_rating INT DEFAULT NULL," +
                "interview_info VARCHAR(32) DEFAULT NULL," +
                "salary_info VARCHAR(32) DEFAULT NULL," +
                "office_location VARCHAR(32) DEFAULT NULL," +
                "date DATETIME DEFAULT CURRENT_TIMESTAMP, " +
                //check( type in(“Full Time”, “Part Time”, “Internship”, “Interview”))
                "PRIMARY KEY (review_id)" +
                ")engine=InnoDB;"
        );
        statement.executeUpdate("CREATE TABLE leaves(" +
                "user_id INT," +
                "FOREIGN KEY(user_id) REFERENCES work_user(user_ID)\n" +
                "ON DELETE CASCADE," +
                "review_id INT," +
                "FOREIGN KEY(review_id) REFERENCES Review(review_ID)\n" +
                "ON DELETE CASCADE " +
                "ON UPDATE CASCADE," +
                "PRIMARY KEY( review_ID)" +
                ")engine=InnoDB;"
        );

        statement.executeUpdate("CREATE TABLE gets(" +
                "user_id INT," +
                "FOREIGN KEY(user_id) REFERENCES comp_user(user_ID)\n" +
                "ON DELETE CASCADE," +
                "review_id INT," +
                "FOREIGN KEY(review_id) REFERENCES review(review_ID)\n" +
                "ON DELETE CASCADE " +
                "ON UPDATE CASCADE," +
                "PRIMARY KEY(review_id)" +
                ")engine=InnoDB;"
        );
        statement.executeUpdate("CREATE TABLE report(" +
                "report_id INT AUTO_INCREMENT," +
                "description VARCHAR(128) NOT NULL," +
                "date DATETIME DEFAULT CURRENT_TIMESTAMP," +
                "subject VARCHAR(32) NOT NULL," +
                "PRIMARY KEY(report_id)" +
                ")engine=InnoDB;"
        );
        statement.executeUpdate("CREATE TABLE has(" +
                "report_id INT," +
                "FOREIGN KEY(report_id) REFERENCES report (report_id)\n" +
                "ON DELETE CASCADE " +
                "ON UPDATE CASCADE," +
                "review_id INT," +
                "FOREIGN KEY(review_id) REFERENCES Review(review_ID)\n" +
                "ON DELETE CASCADE " +
                "ON UPDATE CASCADE," +
                "PRIMARY KEY(report_id)" +
                ")engine=InnoDB;"
        );

        statement.executeUpdate("CREATE TABLE submits(" +
                "user_id INT," +
                "FOREIGN KEY(user_id) REFERENCES comp_user(user_ID)\n" +
                "ON DELETE CASCADE," +
                "report_id INT," +
                "FOREIGN KEY(report_id) REFERENCES report (report_id)\n" +
                "ON DELETE CASCADE " +
                "ON UPDATE CASCADE," +
                "PRIMARY KEY(report_id)" +
                ")engine=InnoDB;"
        );
        statement.executeUpdate("CREATE TABLE admin(" +
                "admin_id INT AUTO_INCREMENT," +
                "password VARCHAR(32) NOT NULL," +
                "email VARCHAR(32) NOT NULL UNIQUE," +
                "PRIMARY KEY(admin_id)" +
                ")engine=InnoDB;"
        );
        statement.executeUpdate("CREATE TABLE checks(" +
                "report_id INT," +
                " FOREIGN KEY(report_id) REFERENCES report (report_id)\n" +
                "ON DELETE CASCADE " +
                "ON UPDATE CASCADE," +
                "admin_id INT," +
                "FOREIGN KEY(admin_id) REFERENCES admin ( admin_id)\n" +
                "ON DELETE CASCADE," +
                "PRIMARY KEY(report_id)" +
                ")engine=InnoDB;"
        );
        statement.executeUpdate("CREATE TABLE job_offering(" +
                "offering_id INT  AUTO_INCREMENT," +
                "date DATETIME DEFAULT CURRENT_TIMESTAMP," +
                "job_title VARCHAR(32) NOT NULL," +
                "job_dept VARCHAR(32) DEFAULT NULL," +
                "job_type VARCHAR(32) DEFAULT NULL," +
                "office_location VARCHAR(32) NOT NULL," +
                "details VARCHAR(128) DEFAULT NULL," +
                "PRIMARY KEY(offering_id)" +
                ")engine=InnoDB;"
        );
        statement.executeUpdate("CREATE TABLE application_test(" +
                "test_id INT AUTO_INCREMENT," +
                "questions VARCHAR(128) NOT NULL," +
                "PRIMARY KEY(test_id)" +
                ")engine=InnoDB;"
        );
        statement.executeUpdate("CREATE TABLE has_test(" +
                "offering_id INT," +
                "FOREIGN KEY(offering_id) REFERENCES job_offering (offering_id)\n" +
                "ON DELETE CASCADE " +
                "ON UPDATE CASCADE," +
                "test_id INT," +
                "FOREIGN KEY(test_id) REFERENCES application_test ( test_id)\n" +
                "ON DELETE CASCADE " +
                "ON UPDATE CASCADE," +
                "PRIMARY KEY(offering_id, test_id)" +
                ")engine=InnoDB;"
        );
        statement.executeUpdate("CREATE TABLE does(" +
                "test_id INT," +
                "FOREIGN KEY(test_id) REFERENCES application_test ( test_id)\n" +
                "ON DELETE CASCADE " +
                "ON UPDATE CASCADE," +
                "user_id INT," +
                "FOREIGN KEY(user_id) REFERENCES work_user (user_id)\n" +
                "ON DELETE CASCADE," +
                "answers VARCHAR(32)," +
                "PRIMARY KEY(test_id,user_id)" +
                ")engine=InnoDB;"
        );
        statement.executeUpdate("CREATE TABLE posts(" +
                "offering_id INT," +
                "FOREIGN KEY(offering_id) REFERENCES job_offering (offering_id)\n" +
                "ON DELETE CASCADE " +
                "ON UPDATE CASCADE," +
                "user_id INT," +
                "FOREIGN KEY(user_id) REFERENCES comp_user (user_id)" +
                "ON DELETE CASCADE," +
                "PRIMARY KEY(offering_id)" +
                ")engine=InnoDB;"
        );
        statement.executeUpdate("CREATE TABLE applies(" +
                "user_id INT," +
                "FOREIGN KEY(user_id) REFERENCES work_user (user_id)\n" +
                "ON DELETE CASCADE," +
                "offering_id INT," +
                "FOREIGN KEY(offering_id) REFERENCES job_offering (offering_id)\n" +
                "ON DELETE CASCADE " +
                "ON UPDATE CASCADE," +
                "PRIMARY KEY(user_id, offering_id)" +
                ")engine=InnoDB;"
        );

    }


}
