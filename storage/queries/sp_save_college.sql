CREATE PROCEDURE IF NOT EXISTS SP_SaveCollege(
        IN pid INT, 
        IN pcode VARCHAR(100), 
        IN pdesc VARCHAR(100),
        IN paction_by_id INT
    )
    BEGIN
    
    DECLARE existing_record_count INT;

    START TRANSACTION;

    SELECT COUNT(*) INTO existing_record_count 
        FROM `tbl_college`
        WHERE collegeid = pid;

    IF(existing_record_count < 1) THEN         
        INSERT INTO `tbl_college` (college, collegedesc)
            VALUES (pcode, pdesc);

        INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Created a new college: ', pdesc), CURRENT_TIMESTAMP, paction_by_id);

    ELSE        
        UPDATE `tbl_college` 
            SET 
                college = pcode, 
                collegedesc = pdesc
            WHERE collegeid = pid;

        INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Updated college: ', pdesc), CURRENT_TIMESTAMP, paction_by_id);
    END IF;

    COMMIT;
END