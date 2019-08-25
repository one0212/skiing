CREATE TABLE SKI_MGNT.SKI_ADMIN(
   id 			INT NOT NULL AUTO_INCREMENT,
   bid 			VARCHAR(4) NOT NULL UNIQUE,
   account 		VARCHAR(20) NOT NULL,
   password		VARCHAR(20) NOT NULL,
   status 		VARCHAR(20) NOT NULL DEFAULT 'DISABLE',
   create_time 	DATETIME DEFAULT NOW() NOT NULL,
   update_time 	DATETIME DEFAULT NOW() NOT NULL,
   PRIMARY KEY (id),
   UNIQUE (bid, account)
);

INSERT INTO SKI.SKI_ADMIN VALUES (
	last_insert_id(),
    'XXXX',
    'admin',
    '123456',
    'ENABLE',
    now(),
    now()
);

SELECT `SKI_ADMIN`.`id`,
    `SKI_ADMIN`.`bid`,
    `SKI_ADMIN`.`account`,
    `SKI_ADMIN`.`password`,
    `SKI_ADMIN`.`status`,
    `SKI_ADMIN`.`create_time`,
    `SKI_ADMIN`.`update_time`
FROM `SKI`.`SKI_ADMIN`;
