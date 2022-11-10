-- Create a Database
-- CREATE DATABASE school_management_system;

-- Table: Admin Login

CREATE TABLE admin_login(
	admin_id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    admin_name varchar(50),
    admin_email_id varchar(50),
    admin_password varchar(20)
);

-- Insert data into admin_login table
INSERT INTO `admin_login`(`admin_name`, `admin_email_id`, `admin_password`) VALUES ('Siddhanta Choudhury','siddhanta2651@gmail.com','1234'),('Basanta Kumar Choudhury','choudhurybasantakumar@gmail.com','1234');

-- Table: Student_Details

CREATE TABLE student_details(
	student_id varchar(10) NOT NULL PRIMARY KEY,
    email varchar(40),
    name varchar(30),
    date_of_admission DATE,
    phone_Number varchar(12),
    roll_no varchar(10),
    year_of_admission varchar(12),
    gender varchar(8),
    class varchar(6),
    adhar_number varchar(15),
    status varchar(12),
    dob date,
    section char(5),
    password varchar(15)
);

-- Insert into Student Details
-- INSERT INTO `student_details`(`student_id`, `email`, `name`, `date_of_admission`, `phone_Number`, `roll_no`, `year_of_admission`, `gender`, `class`, `adhar_number`, `account_status`, `dob`, `section`,`password`) VALUES ('S001','siddhanta.c1729@gmail.com','Siddhanta Choudhury','2022-07-11','8658607379','2022/001','2022','Male','11','123456789101','Complete','2001-08-26','A','1234');

-- Table: Department
CREATE TABLE department(
	dept_id varchar(10) NOT NULL PRIMARY KEY,
    dept_name varchar(30),
    dept_code varchar(10)
);

INSERT INTO `department`(`dept_id`, `dept_name`, `dept_code`) VALUES ('D01','Mathematics','MTH'),('D02','Physics','PHY'),('D03','Chemistry','CHEM'),('D04','Zoology','ZOO'),('D05','Botany','BOT'),('D06','English','ENG'),('D07','Odia','ODIA'),('D08','Hindi','HINDI'),('D09','Sanskrit','SANSKRIT'),('D10','Information Technology','IT');

-- Faculty Table
CREATE TABLE faculty(
	faculty_id varchar(10) NOT NULL PRIMARY KEY,
    faculty_name varchar(30),
    designation varchar(15),
    mobile_number varchar(13),
    subject_id_taken_cl_11 varchar(20),
    subject_id_taken_cl_12 varchar(20),
    dept_id varchar(10),
    FOREIGN KEY(dept_id) REFERENCES department(dept_id)
);

-- -- Insert into Faculty
-- INSERT INTO `faculty` (`faculty_id`, `faculty_name`, `designation`, `mobile_number`, `subject_id_taken_cl_11`, `subject_id_taken_cl_12`,`dept_id`) VALUES ('F001', 'Dr. S.K. Singh', 'HOD', '4562178936', 'Zoology', NULL,'D04');

-- INSERT INTO `faculty` (`faculty_id`, `faculty_name`, `designation`, `mobile_number`, `subject_id_taken_cl_11`, `subject_id_taken_cl_12`,`dept_id`) VALUES ('F002', 'Dr. Rahul Naik', 'HOD', '4523478936', 'Physics','Physics','D02');


-- Registered student table
CREATE TABLE registered_student_details(
	sl_no int(10) not NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(30),
    email varchar(40),
    phNumber varchar(13),
    gender varchar(10),
    password varchar(20),
    cpassword varchar(20)
);

-- Contact US Table
CREATE TABLE contact_us(
    sl_no int(10) not null AUTO_INCREMENT PRIMARY KEY,
    name varchar(30),
    phone_number varchar(14),
    email varchar(50),
    Gender varchar(14),
    about varchar(300)
);


-- Table: Parent_details

CREATE TABLE parent_details(
	id varchar(10),
    father_name varchar(30),
    mother_name varchar(30),
    email varchar(40),
    parent_phone_Number varchar(12),
    parent_adhar_number varchar(15),
    FOREIGN KEY (id)
    REFERENCES student_details(student_id)
);

-- Table: Address

CREATE TABLE address(
	id varchar(10),
    address1 varchar(40),
    address2 varchar(40),
    district varchar(15),
    state varchar(20),
   	pin varchar(12),
    country varchar(15),
    FOREIGN KEY (id)
    REFERENCES student_details(student_id)
);

-- Subject Table

-- CREATE TABLE subject(
-- 	subject_id varchar(10) NOT NULL PRIMARY KEy,
--     subject_name varchar(20),
--     class varchar(12)
-- );

-- INSERT INTO `subject`(`subject_id`, `subject_name`, `class`) VALUES ('MTH11','Mathematics','11'),('PHY11','Physics','11'),('CHEM11','Chemistry','11'),('ZOO11','Zoology','11'),('BOT11','Botany','11'),('IT11','Information Technology','11'),('ENG11','English','11'),('ODIA11','Odia','11'),('HINDI11','Hindi','11'),('SANS11','Sanskrit','11'),('LPHY11','Physics Practical','11'),('LCHEM11','Chemistry Practical','11'),('LZOO11','Zoology Practical','11'),('LBOT11','Botany Practical','11');

-- INSERT INTO `subject`(`subject_id`, `subject_name`, `class`) VALUES ('MTH12','Mathematics','12'),('PHY12','Physics','12'),('CHEM12','Chemistry','12'),('ZOO12','Zoology','12'),('BOT12','Botany','12'),('IT12','Information Technology','12'),('ENG12','English','12'),('ODIA12','Odia','12'),('HINDI12','Hindi','12'),('SANS12','Sanskrit','12'),('LPHY12','Physics Practical','12'),('LCHEM12','Chemistry Practical','12'),('LZOO12','Zoology Practical','12'),('LBOT12','Botany Practical','12');

-- Internals

CREATE table first_internal(
	student_id varchar(10) UNIQUE NOT NULL,
    roll_no varchar(10) UNIQUE NOT NULL,
    Mathematics float(10,2) NULL,
    Physics float(10,2) NULL,
    Chemistry float(10,2) NULL,
    English float(10,2) NULL,
    Zoology float(10,2) NULL,
    Botany float(10,2) NULL,
    Information_Technology float(10,2) NULL,
    Odia float(10,2) NULL,
    Sanskrit float(10,2) NULL,
    Hindi float(10,2) NULL,
    Physics_Lab float(10,2) NULL,
    Chemistry_Lab float(10,2) NULL,
    Zoology_Lab float(10,2) NULL,
    Botany_Lab float(10,2) NULL,
    Information_Technology_Lab float(10,2) NULL,
    FOREIGN KEY(student_id) REFERENCES student_details(student_id)
);

CREATE table second_internal(
	student_id varchar(10) UNIQUE NOT NULL,
    roll_no varchar(10) UNIQUE NOT NULL,
    Mathematics float(10,2) NULL,
    Physics float(10,2) NULL,
    Chemistry float(10,2) NULL,
    English float(10,2) NULL,
    Zoology float(10,2) NULL,
    Botany float(10,2) NULL,
    Information_Technology float(10,2) NULL,
    Odia float(10,2) NULL,
    Sanskrit float(10,2) NULL,
    Hindi float(10,2) NULL,
    Physics_Lab float(10,2) NULL,
    Chemistry_Lab float(10,2) NULL,
    Zoology_Lab float(10,2) NULL,
    Botany_Lab float(10,2) NULL,
    Information_Technology_Lab float(10,2) NULL,
    FOREIGN KEY(student_id) REFERENCES student_details(student_id)
);


CREATE table endterm(
	student_id varchar(10) UNIQUE NOT NULL,
    roll_no varchar(10) UNIQUE NOT NULL,
    Mathematics float(10,2) NULL,
    Physics float(10,2) NULL,
    Chemistry float(10,2) NULL,
    English float(10,2) NULL,
    Zoology float(10,2) NULL,
    Botany float(10,2) NULL,
    Information_Technology float(10,2) NULL,
    Odia float(10,2) NULL,
    Sanskrit float(10,2) NULL,
    Hindi float(10,2) NULL,
    Physics_Lab float(10,2) NULL,
    Chemistry_Lab float(10,2) NULL,
    Zoology_Lab float(10,2) NULL,
    Botany_Lab float(10,2) NULL,
    Information_Technology_Lab float(10,2) NULL,
    FOREIGN KEY(student_id) REFERENCES student_details(student_id)
);

-- Table: Exam summary

CREATE TABLE exam_summary(
	id varchar(10) UNIQUE NOT NULL,
    roll_no varchar(10) UNIQUE NOT NULL,
    total_1st_internal int(5) DEFAULT 0,
    percentage_1st_internal float(8,2) DEFAULT 0,
    grade_1st_internal char(5) NULL,
    total_2nd_internal int(5) DEFAULT 0,
    percentage_2nd_internal float(8,2) DEFAULT 0,
    grade_2nd_internal char(5) NULL,
    total_endterm int(5) DEFAULT 0,
    percentage_endterm float(8,2) DEFAULT 0,
    grade_endterm char(5) NULL,
    status varchar(10) DEFAULT NULL, 
    FOREIGN KEY (id)
    REFERENCES student_details(student_id)
);


-- Table: Fee Structure

CREATE TABLE fee_structure(
	id varchar(10) NOT NULL,
    roll_no VARCHAR(10) NOT NULL,
    type varchar(15),
    accademic_amount_fee float(10,2) DEFAULT 0.0,
    hostel_amount_fee float(10,2) DEFAULT 0.0,
    date_of_accademic_amount_payment date,
    date_of_hostel_amount_payment date,
    -- Boarder or Non Boarder    
    accademic_fee_status varchar(20) DEFAULT NULL,
    hostel_fee_status varchar(20) DEFAULT NULL,
    account_status varchar(20) DEFAULT NULL,
    FOREIGN KEY (id)
    REFERENCES student_details(student_id)
);

-- Table: Exam Summary of class 12

CREATE TABLE exam_summary_class_12(
    id VARCHAR(10) UNIQUE NOT NULL,
    roll_no VARCHAR(10) UNIQUE NOT NULL,
    total_1st_internal int(5) DEFAULT 0,
    percentage_1st_internal float(8,2) DEFAULT 0,
    grade_1st_internal char(5) NULL,
    total_2nd_internal int(5) DEFAULT 0,
    percentage_2nd_internal float(8,2) DEFAULT 0,
    grade_2nd_internal char(5) NULL,
    total_endterm int(5) DEFAULT 0,
    percentage_endterm float(8,2) DEFAULT 0,
    grade_endterm char(5) NULL,
    status varchar(10) DEFAULT NULL, 
    FOREIGN KEY (id)
    REFERENCES student_details(student_id)
);

-- Internals class 12

CREATE table first_internal_class_12(
	student_id varchar(10) UNIQUE NOT NULL,
    roll_no varchar(10) UNIQUE NOT NULL,
    Mathematics float(10,2) NULL,
    Physics float(10,2) NULL,
    Chemistry float(10,2) NULL,
    English float(10,2) NULL,
    Zoology float(10,2) NULL,
    Botany float(10,2) NULL,
    Information_Technology float(10,2) NULL,
    Odia float(10,2) NULL,
    Sanskrit float(10,2) NULL,
    Hindi float(10,2) NULL,
    Physics_Lab float(10,2) NULL,
    Chemistry_Lab float(10,2) NULL,
    Zoology_Lab float(10,2) NULL,
    Botany_Lab float(10,2) NULL,
    Information_Technology_Lab float(10,2) NULL,
    FOREIGN KEY(student_id) REFERENCES student_details(student_id)
);

CREATE table second_internal_class_12(
	student_id varchar(10) UNIQUE NOT NULL,
    roll_no varchar(10) UNIQUE NOT NULL,
    Mathematics float(10,2) NULL,
    Physics float(10,2) NULL,
    Chemistry float(10,2) NULL,
    English float(10,2) NULL,
    Zoology float(10,2) NULL,
    Botany float(10,2) NULL,
    Information_Technology float(10,2) NULL,
    Odia float(10,2) NULL,
    Sanskrit float(10,2) NULL,
    Hindi float(10,2) NULL,
    Physics_Lab float(10,2) NULL,
    Chemistry_Lab float(10,2) NULL,
    Zoology_Lab float(10,2) NULL,
    Botany_Lab float(10,2) NULL,
    Information_Technology_Lab float(10,2) NULL,
    FOREIGN KEY(student_id) REFERENCES student_details(student_id)
);


CREATE table endterm_class_12(
	student_id varchar(10) UNIQUE NOT NULL,
    roll_no varchar(10) UNIQUE NOT NULL,
    Mathematics float(10,2) NULL,
    Physics float(10,2) NULL,
    Chemistry float(10,2) NULL,
    English float(10,2) NULL,
    Zoology float(10,2) NULL,
    Botany float(10,2) NULL,
    Information_Technology float(10,2) NULL,
    Odia float(10,2) NULL,
    Sanskrit float(10,2) NULL,
    Hindi float(10,2) NULL,
    Physics_Lab float(10,2) NULL,
    Chemistry_Lab float(10,2) NULL,
    Zoology_Lab float(10,2) NULL,
    Botany_Lab float(10,2) NULL,
    Information_Technology_Lab float(10,2) NULL,
    FOREIGN KEY(student_id) REFERENCES student_details(student_id)
);

-- Table: Fee Structure

CREATE TABLE fee_structure_class_12(
	id varchar(10) NOT NULL,
    roll_no VARCHAR(10) NOT NULL,
    type varchar(15),
    accademic_amount_fee float(10,2) DEFAULT 0.0,
    hostel_amount_fee float(10,2) DEFAULT 0.0,
    date_of_accademic_amount_payment date,
    date_of_hostel_amount_payment date,
    -- Boarder or Non Boarder    
    accademic_fee_status varchar(20) DEFAULT NULL,
    hostel_fee_status varchar(20) DEFAULT NULL,
    account_status varchar(20) DEFAULT NULL,
    FOREIGN KEY (id)
    REFERENCES student_details(student_id)
);

-- student_details_those_are_passed_from_class_11

CREATE TABLE student_details_those_are_passed_from_class_11(
	student_id varchar(10) UNIQUE NOT NULL,
    roll_no varchar(10) UNIQUE NOT NULL,
    previous_class varchar(10)
);