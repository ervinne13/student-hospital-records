CREATE PROCEDURE IF NOT EXISTS SP_StudentsDatatable(
        IN psearch VARCHAR(100), 
        IN sortColumn VARCHAR(100), 
        IN sortOrder VARCHAR(100), 
        IN poffset INT, 
        IN pfetch_count INT
    )
    BEGIN    

    IF (NOT psearch IS NULL AND psearch != '') THEN
        SET @quotedPSearch = QUOTE(CONCAT('%', psearch, '%'));
        SET @whereClause = CONCAT(
            ' WHERE SN LIKE ', @quotedPSearch,
            ' OR first_name LIKE ', @quotedPSearch,
            ' OR last_name LIKE ', @quotedPSearch,
            ' OR collegecde LIKE ', @quotedPSearch,
            ' OR course LIKE ', @quotedPSearch,
            ' OR age LIKE ', @quotedPSearch,
            ' OR gender LIKE ', @quotedPSearch,
            ' OR yearlevel LIKE ', @quotedPSearch,
            ' OR address LIKE ', @quotedPSearch,
            ' OR weight LIKE ', @quotedPSearch,
            ' OR height LIKE ', @quotedPSearch,
            ' OR complexion LIKE ', @quotedPSearch,
            ' OR civil_status LIKE ', @quotedPSearch,
            ' OR cp_no LIKE ', @quotedPSearch,
            ' OR tel_no LIKE ', @quotedPSearch,
            ' OR bday LIKE ', @quotedPSearch            
         );
    ELSE
        SET @whereClause = '';
    END IF;    

    IF (NOT sortColumn IS NULL AND sortColumn != '') THEN
        SET @orderClause = CONCAT(' ORDER BY ', sortColumn, ' ', sortOrder);
    ELSE
        SET @orderClause ='';
    END IF;

    SET @limitClause = CONCAT(' LIMIT ', poffset, ', ', pfetch_count);
    SET @stmt = CONCAT('SELECT * FROM `tbl_studentlist` ', @whereClause, @orderClause, @limitClause, ';');

    PREPARE stmt FROM @stmt;

    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;

END