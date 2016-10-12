CREATE PROCEDURE IF NOT EXISTS SP_SaveVitalSigns(
        IN psy VARCHAR(100), 
        IN psem VARCHAR(100), 
        IN pSN BIGINT,
        IN ppulse_rate INT,
        IN pblood_pressure VARCHAR(10),
        IN pvision VARCHAR(255),
        IN pcolor_vision VARCHAR(255),
        IN phearing VARCHAR(255),
        IN plicense_no INT,
        IN paction_by_id INT
    )
    BEGIN
    
    DECLARE existing_record_count INT;

    START TRANSACTION;

    SELECT COUNT(*) INTO existing_record_count 
        FROM `tbl_vitalsigns`
        WHERE SY = psy
        AND sem = psem
        AND SN = pSN;

    IF(existing_record_count < 1) THEN
        INSERT INTO `tbl_vitalsigns` (SY, sem, SN, pulse_rate, blood_pressure, vision, color_vision, hearing, license_no)
            VALUES (psy, psem, pSN, ppulse_rate, pblood_pressure, pvision, pcolor_vision, phearing, plicense_no);

        INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Created a new vital signs record for student : ', pSN, ', school year: ', psy, ' ', psem, ' semester'), CURRENT_TIMESTAMP, paction_by_id);

    ELSE        
        UPDATE `tbl_vitalsigns` 
            SET 
                SY = psy, 
                sem = psem,
                SN = pSN,
                pulse_rate = ppulse_rate, 
                blood_pressure = pblood_pressure, 
                vision = pvision, 
                color_vision = pcolor_vision, 
                hearing = phearing, 
                license_no = plicense_no               
            WHERE SY = psy
            AND sem = psem
            AND SN = pSN;

        INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Updated new vital signs record for student : ', pSN, ', school year: ', psy, ' ', psem, ' semester'), CURRENT_TIMESTAMP, paction_by_id);
    END IF;

    COMMIT;
END