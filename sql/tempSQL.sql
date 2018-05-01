INSERT INTO `account`(`userName`, `password`, `accID`) VALUES ("claude", "claude", 3)

INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Shield','10','50','Armor', 17);
INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Shield','10','50','Armor', 18);
INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Shield','10','50','Armor', 22);
INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Shield','10','50','Armor', 21);
INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Bow','2','100','Weapon', 16);
INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Food','20','20','Misc', 20);
INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Talons','4','8','Weapon', 22);
INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Chain','20','10','Weapon', 19);
INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Chain','20','10','Weapon', 19);


INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Dwarven Plate','100','1000','Armor', 1);
INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Orc Jerkin','2','10','Armor', 1);
INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Troll Hide Boots','2','100','Armor', 1);

INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Grick Eyes','3','99','Misc', 1);
INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Orc Teeth','1','5','Misc', 1);
INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Troll Rubber','7','33','Misc', 1);

INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Dwarven Axe','2','200','Weapon', 1);
INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Crossbow','10','75','Weapon', 1);
INSERT INTO `items`(`thumbnail`, `itemName`, `itemWeight`, `itemValue`, `itemType`, `charID`) VALUES ('','Pickaxe','5','12','Weapon', 1);
------

SELECT accID, charName, partyID
FROM characters
JOIN 

-- we look for accounts with
-- characters in certain paries

--List all items in a party (Join Items & Party)

SELECT charName, it.charID, 
partyName, pa.partyID,
itemname, itemWeight, itemValue, itemType FROM characters
JOIN party pa ON characters.partyID = pa.partyID
JOIN items it ON characters.charID = it.charID;


--# of items of x type carried
--Join to show which char is carrying

SELECT charName, ch.charID, itemType, count(itemName) FROM items it
JOIN characters ch ON ch.charID = it.charID
where itemType = 'Armor' AND ch.charID = 1;

SELECT charName, ch.charID, SUM(itemWeight) FROM items it
JOIN characters ch ON ch.charID = it.charID
GROUP BY charName;

SELECT charName, ch.charID, SUM(itemValue) FROM items it
JOIN characters ch ON ch.charID = it.charID
GROUP BY charName;