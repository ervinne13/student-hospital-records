CREATE PROCEDURE IF NOT EXISTS SP_SaveXRay(
        IN psy VARCHAR(100), 
        IN psem VARCHAR(100), 
        IN pSN BIGINT,
        IN pfindings TEXT,
        IN paction_by_id INT
    )
    BEGIN
    
    DECLARE existing_record_count INT;

    START TRANSACTION;

    SELECT COUNT(*) INTO existing_record_count 
        FROM `tbl_xray`
        WHERE SY = psy
        AND sem = psem
        AND SN = pSN;

    IF(existing_record_count < 1) THEN         
        INSERT INTO `tbl_xray` (SY, sem, SN, findings, date_saved)
            VALUES (psy, psem, pSN, pfindings, CURRENT_TIMESTAMP);

        INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Created a new xray record for student : ', pSN, ', school year: ', psy, ' ', psem, ' semester'), CURRENT_TIMESTAMP, paction_by_id);

    ELSE        
        UPDATE `tbl_xray` 
            SET 
                SY = psy, 
                sem = psem,
                SN = pSN,
                findings = pfindings,
                date_saved = CURRENT_TIMESTAMP
            WHERE SY = psy
            AND sem = psem
            AND SN = pSN;

        INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Updated new xray record for student : ', pSN, ', school year: ', psy, ' ', psem, ' semester'), CURRENT_TIMESTAMP, paction_by_id);
    END IF;

    COMMIT;
END