CREATE PROCEDURE IF NOT EXISTS SP_RegisterUserAccount(
        IN pusername VARCHAR(100), 
        IN pcomplete_name VARCHAR(100), 
        IN pusertype VARCHAR(100), 
        IN plicense_no VARCHAR(100), 
        IN pmodifiedby INT, 
        IN ppassword VARCHAR(100), 
        IN ppassword_repeat VARCHAR(100), 
        IN phashed_password VARCHAR(100),
        IN paction_by_id INT
    )
    BEGIN
    
    IF(ppassword != ppassword_repeat) THEN 
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Passwords do not match ';
    END IF;

    START TRANSACTION;

    INSERT INTO `tbl_useraccount` (username, complete_name, usertype, physician_license_no, modifiedby, password, modifieddate)
        VALUES (pusername, pcomplete_name, pusertype, plicense_no, pmodifiedby, phashed_password, CURRENT_TIMESTAMP);

    INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Created user ', pusername), CURRENT_TIMESTAMP, paction_by_id);

    COMMIT;

END