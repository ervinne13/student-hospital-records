CREATE PROCEDURE IF NOT EXISTS SP_GetUserById(IN id INT)
    BEGIN
    SELECT * FROM tbl_useraccount 
    LEFT JOIN tbl_usertype 
        ON usertype = typeid 
    WHERE userid = id;
END