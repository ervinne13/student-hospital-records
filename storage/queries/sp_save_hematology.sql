CREATE PROCEDURE IF NOT EXISTS SP_SaveHematology(
        IN psy VARCHAR(100), 
        IN psem VARCHAR(100), 
        IN pSN BIGINT,
        IN phemoglobin FLOAT,
        IN phematocrit FLOAT,
        IN pred_blood FLOAT,
        IN pplatelet FLOAT,
        IN psegmenters FLOAT,
        IN plymphocytes FLOAT,
        IN pmonocytes FLOAT,
        IN peosinophiles FLOAT,
        IN pstab_cells FLOAT,
        IN pbasophiles FLOAT,
        IN paction_by_id INT
    )
    BEGIN
    
    DECLARE existing_record_count INT;

    START TRANSACTION;

    SELECT COUNT(*) INTO existing_record_count 
        FROM `tbl_hematology`
        WHERE SY = psy
        AND sem = psem
        AND SN = pSN;

    IF(existing_record_count < 1) THEN
        INSERT INTO `tbl_hematology` (SY, sem, SN, hemoglobin, hematocrit, red_blood, platelet, segmenters, lymphocytes, monocytes, eosinophiles, stab_cells, basophiles, date_saved)
            VALUES (psy, psem, pSN, phemoglobin, phematocrit, pred_blood, pplatelet, psegmenters, plymphocytes, pmonocytes, peosinophiles, pstab_cells, pbasophiles, CURRENT_TIMESTAMP);

        INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Created a new hematology record for student : ', pSN, ', school year: ', psy, ' ', psem, ' semester'), CURRENT_TIMESTAMP, paction_by_id);

    ELSE        
        UPDATE `tbl_hematology` 
            SET 
                SY = psy, 
                sem = psem,
                SN = pSN,
                hemoglobin = phemoglobin,
                hematocrit = phematocrit,
                red_blood = pred_blood,
                platelet = pplatelet,
                segmenters = psegmenters,
                lymphocytes = plymphocytes,
                monocytes = pmonocytes,
                eosinophiles = peosinophiles,
                stab_cells = pstab_cells,
                basophiles = pbasophiles, 
                date_saved = CURRENT_TIMESTAMP
            WHERE SY = psy
            AND sem = psem
            AND SN = pSN;

        INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Updated new hematology record for student : ', pSN, ', school year: ', psy, ' ', psem, ' semester'), CURRENT_TIMESTAMP, paction_by_id);
    END IF;

    COMMIT;
END