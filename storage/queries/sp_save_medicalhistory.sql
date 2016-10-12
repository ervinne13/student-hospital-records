CREATE PROCEDURE IF NOT EXISTS SP_SaveMedicalHistory(
        IN psy VARCHAR(100), 
        IN psem VARCHAR(100), 
        IN pSN BIGINT,
        IN ppresent_symptoms TEXT,
        IN phypertension TINYINT(1),
        IN pdiabetes TINYINT(1),
        IN pcardiac TINYINT(1),
        IN pastma TINYINT(1),
        IN pothers TEXT,
        IN plicense_no INT,
        IN paction_by_id INT
    )
    BEGIN
    
    DECLARE existing_record_count INT;

    START TRANSACTION;

    SELECT COUNT(*) INTO existing_record_count 
        FROM `tbl_medicalhistory`
        WHERE SY = psy
        AND sem = psem
        AND SN = pSN;

    IF(existing_record_count < 1) THEN
        INSERT INTO `tbl_medicalhistory` (SY, sem, SN, 
            present_symptoms,
            hypertension,
            diabetes,
            cardiac,
            astma,
            others,
            license_no)
            VALUES (psy, psem, pSN, 
                ppresent_symptoms,
                phypertension,
                pdiabetes,
                pcardiac,
                pastma,
                pothers,
                plicense_no);

        INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Created a new vital signs record for student : ', pSN, ', school year: ', psy, ' ', psem, ' semester'), CURRENT_TIMESTAMP, paction_by_id);

    ELSE        
        UPDATE `tbl_medicalhistory` 
            SET 
                SY = psy, 
                sem = psem,
                SN = pSN,
                present_symptoms=ppresent_symptoms,
                hypertension=phypertension,
                diabetes=pdiabetes,
                cardiac=pcardiac,
                astma=pastma,
                others=pothers,
                license_no = plicense_no               
            WHERE SY = psy
            AND sem = psem
            AND SN = pSN;

        INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Updated new vital signs record for student : ', pSN, ', school year: ', psy, ' ', psem, ' semester'), CURRENT_TIMESTAMP, paction_by_id);
    END IF;

    COMMIT;
END