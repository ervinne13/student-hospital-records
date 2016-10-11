CREATE PROCEDURE IF NOT EXISTS SP_UpdateUserAccount(
        IN puserid INT,
        IN pusername VARCHAR(100), 
        IN pcomplete_name VARCHAR(100), 
        IN pusertype VARCHAR(100), 
        IN pmodifiedby INT, 
        IN ppassword VARCHAR(100), 
        IN ppassword_repeat VARCHAR(100),
        IN phashed_new_password VARCHAR(100)        
    )
    BEGIN
    
    DECLARE hashed_old_password VARCHAR(100);

    IF(ppassword != ppassword_repeat) THEN 
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Passwords do not match ';
    END IF;

    START TRANSACTION;

    UPDATE `tbl_useraccount` SET
        username=pusername,
        complete_name=pcomplete_name,
        usertype=pusertype,
        modifiedby=pmodifiedby,
        password=phashed_new_password,
        modifieddate=CURRENT_TIMESTAMP
    WHERE userid=puserid;

     INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Updated account: ', pusername), CURRENT_TIMESTAMP, pmodifiedby);

    COMMIT;
END