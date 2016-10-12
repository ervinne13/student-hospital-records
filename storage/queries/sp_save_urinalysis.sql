CREATE PROCEDURE IF NOT EXISTS SP_SaveUrinalysis(
        IN psy VARCHAR(100), 
        IN psem VARCHAR(100), 
        IN pSN BIGINT,
        IN pcolor VARCHAR(45),
        IN ptransparency VARCHAR(45),
        IN preaction VARCHAR(45),
        IN psp_gravity VARCHAR(45),
        IN psugar VARCHAR(45),
        IN pprotein VARCHAR(45),
        IN ppus_cells VARCHAR(45),
        IN pred_cells VARCHAR(45),
        IN pepithelial_cells VARCHAR(45),
        IN pm_thread VARCHAR(45),
        IN pbacteria VARCHAR(45),
        IN pcrystals VARCHAR(45),
        IN pothers VARCHAR(45),
        IN paction_by_id INT
    )
    BEGIN
    
    DECLARE existing_record_count INT;

    START TRANSACTION;

    SELECT COUNT(*) INTO existing_record_count 
        FROM `tbl_urinalysis`
        WHERE SY = psy
        AND sem = psem
        AND SN = pSN;

    IF(existing_record_count < 1) THEN
        INSERT INTO `tbl_urinalysis` (SY, sem, SN, 
            color,
            transparency,
            reaction,
            sp_gravity,
            sugar,
            protein,
            pus_cells,
            red_cells,
            epithelial_cells,
            m_thread,
            bacteria,
            crystals,
            others,
            date_saved)
            VALUES (psy, psem, pSN,  color,
                ptransparency,
                preaction,
                psp_gravity,
                psugar,
                pprotein,
                ppus_cells,
                pred_cells,
                pepithelial_cells,
                pm_thread,
                pbacteria,
                pcrystals,
                pothers,
                CURRENT_TIMESTAMP);

        INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Created a new urinalysis record for student : ', pSN, ', school year: ', psy, ' ', psem, ' semester'), CURRENT_TIMESTAMP, paction_by_id);

    ELSE        
        UPDATE `tbl_urinalysis` 
            SET 
                SY = psy, 
                sem = psem,
                SN = pSN,
                color=pcolor,
                transparency=ptransparency,
                reaction=preaction,
                sp_gravity=psp_gravity,
                sugar=psugar,
                protein=pprotein,
                pus_cells=ppus_cells,
                red_cells=pred_cells,
                epithelial_cells=pepithelial_cells,
                m_thread=pm_thread,
                bacteria=pbacteria,
                crystals=pcrystals,
                others=pothers,
                date_saved=CURRENT_TIMESTAMP
            WHERE SY = psy
            AND sem = psem
            AND SN = pSN;

        INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Updated new urinalysis record for student : ', pSN, ', school year: ', psy, ' ', psem, ' semester'), CURRENT_TIMESTAMP, paction_by_id);
    END IF;

    COMMIT;
END