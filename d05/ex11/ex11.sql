SELECT UPPER(last_name) as 'NAME', first_name, price
FROM db_lberezyn.subscription 
INNER JOIN db_lberezyn.member using(id_sub)
INNER JOIN db_lberezyn.user_card
ON id_user_card = id_user
WHERE (price > 42)
ORDER BY last_name
ASC, first_name
ASC
;