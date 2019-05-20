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
        statement.executeUpdate("insert into work_user values(1,\"Robert Plant\", \"Musician\", \"I was a member of Led Zeppelin\", \"Jumping\",\"Heaven Apt\",\"Stairway Sokak\",\"Kashmir\",\"Izmir\",\"Turkey\",35121);");
        statement.executeUpdate("insert into general_user values(2,\"gasper@mail.com\",\"1234\",\"3535312635\",DEFAULT,\"http://tr.web.img4.acsta.net/c_215_290/medias/nmedia/18/94/69/75/20349187.jpg\");");
        statement.executeUpdate("insert into work_user values(2,\"Gasper Noe\", \"Director\", \"Enter the Void \nIrreversible\nLove\nClimax\", \"Puff\",\"Void Apt\",\"Climax Sokak\",\" Irreversible\",\"Buenos Aires\",\"Argentina\",35121);");
        statement.executeUpdate("insert into general_user values(3,\"50cent@mail.com\",\"1234\",\"353523515\",DEFAULT,\"https://static.hiphopdx.com/2017/11/171128-G-Unit-Getty-Images-800x600.jpg\");");
        statement.executeUpdate("insert into comp_user values(3,\"G-Unit\", \"RAPPER\");");
        statement.executeUpdate("insert into location values(3,\"Gangsta Apt\",\"palmiye Sokak\",\"balcova\",\"Izmir\",\"Turkey\",16241,1);");
        statement.executeUpdate("insert into location values(3,\"Tren Apt\",\"Lider Sokak\",\"Yoa chi\",\"Tokyo\",\"Japon\",12451,0);");
        //picture
        statement.executeUpdate("insert into picture values(3,\"https://picsum.photos/id/0/5616/3744\",DEFAULT,\"Muthis foto\");");
        statement.executeUpdate("insert into picture values(3,\"https://picsum.photos/id/1/5616/3744\",DEFAULT,\"Muthis  foto\");");
        statement.executeUpdate("insert into picture values(3,\"https://picsum.photos/id/25/5616/3744\",DEFAULT,\"Muthis  foto\");");
        statement.executeUpdate("insert into picture values(3,\"https://picsum.photos/id/11/5616/3744\",DEFAULT,\"Muthis  foto\");");
        statement.executeUpdate("insert into picture values(3,\"https://picsum.photos/id/4/5616/3744\",DEFAULT,\"Muthis  foto\");");
        statement.executeUpdate("insert into picture values(3,\"https://picsum.photos/id/5/5616/3744\",DEFAULT,\"Muthis  foto\");");
        statement.executeUpdate("insert into picture values(3,\"https://picsum.photos/id/6/5616/3744\",DEFAULT,\"Muthis  foto\");");
        statement.executeUpdate("insert into picture values(3,\"https://picsum.photos/id/7/5616/3744\",DEFAULT,\"Muthis  foto\");");
        statement.executeUpdate("insert into picture values(3,\"https://picsum.photos/id/8/5616/3744\",DEFAULT,\"Muthis  foto\");");
        statement.executeUpdate("insert into picture values(3,\"https://picsum.photos/id/9/5616/3744\",DEFAULT,\"Muthis  foto\");");
        statement.executeUpdate("insert into picture values(3,\"https://picsum.photos/id/10/5616/3744\",DEFAULT,\"Muthis  foto\");");
        //Job offering
        statement.executeUpdate("INSERT INTO job_offering values (DEFAULT,DEFAULT, 'Amelelik', 'Santiye', 'Isci', 'Izmir', 'Tugla Tasi')");
        statement.executeUpdate("insert into posts values(1,3)");
        statement.executeUpdate("INSERT INTO job_offering values (DEFAULT,DEFAULT, 'Temizleyici', 'hastane', 'temizlik', 'Yozgat', 'sil supur')");
        statement.executeUpdate("insert into posts values(2,3)");
        //Job applies
        statement.executeUpdate("insert into applies values(1,1,'Pending')");
        statement.executeUpdate("insert into applies values(2,1,'Accepted')");
        statement.executeUpdate("insert into applies values(2,2,'Rejected')");
        //Add Application Test
        statement.executeUpdate("insert into application_test values(1,1,'What is your Name?');");
        statement.executeUpdate("insert into application_test values(2,1,'Where are you from?');");
        //Add Review
        statement.executeUpdate("INSERT INTO `review` (`review_id`, `anonymity`, `type`, `review_text`, `comp_rating`, `ceo_rating`, `interview_info`, `salary_info`, `office_location`, `user_id`, `comp_id`, `date`) VALUES (NULL, '0', 'Internship', 'Güzel Şirket', 5, 5, 'Kolay', '1500₺', 'Izmir', 1, 3, CURRENT_TIMESTAMP);");
        statement.executeUpdate("INSERT INTO `review` (`review_id`, `anonymity`, `type`, `review_text`, `comp_rating`, `ceo_rating`, `interview_info`, `salary_info`, `office_location`, `user_id`, `comp_id`, `date`) VALUES (NULL, '0', 'Full Time', 'nice', 4, 4, 'EZ', '4000₺', 'Izmir', 2, 3, CURRENT_TIMESTAMP);");
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
                "FOREIGN KEY(comp_ID) REFERENCES Comp_user(user_ID) \n" +
                "ON DELETE CASCADE," +
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
                "FOREIGN KEY(user_ID) REFERENCES comp_user(user_ID)\n" +
                "ON DELETE CASCADE," +
                "link VARCHAR(128) NOT NULL, " +
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
                "user_id VARCHAR(32) DEFAULT NULL," +
                "comp_id VARCHAR(32) DEFAULT NULL," +
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
                "user_id INT," +
                "FOREIGN KEY(user_id) REFERENCES comp_user(user_ID)\n" +
                "ON DELETE CASCADE," +
                "report_id INT AUTO_INCREMENT," +
                "description VARCHAR(128) NOT NULL," +
                "date DATETIME DEFAULT CURRENT_TIMESTAMP," +
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
                "question_id INT AUTO_INCREMENT," +
                "offering_id INT," +
                "FOREIGN KEY(offering_id) REFERENCES job_offering(offering_id)\n" +
                "ON DELETE CASCADE, " +
                "question VARCHAR(128) NOT NULL," +
                "PRIMARY KEY( question_id, offering_id)" +
                ")engine=InnoDB;"
        );

        statement.executeUpdate("CREATE TABLE does(" +
                "offering_id INT," +
                "FOREIGN KEY(offering_id) REFERENCES application_test ( offering_id)\n" +
                "ON DELETE CASCADE " +
                "ON UPDATE CASCADE," +
                "user_id INT," +
                "FOREIGN KEY(user_id) REFERENCES work_user (user_id)\n" +
                "ON DELETE CASCADE," +
                "question_id INT," +
                "FOREIGN KEY (question_id) REFERENCES application_test (question_id)\n" +
                "ON DELETE CASCADE," +
                "answers VARCHAR(32)," +
                "PRIMARY KEY(offering_id,user_id, question_id)" +
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
                "status VARCHAR(32)," +
                "PRIMARY KEY(user_id, offering_id)" +
                ")engine=InnoDB;"
        );

    }


}
