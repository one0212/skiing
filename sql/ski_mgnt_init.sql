CREATE TABLE SKI.MGNT_ADMIN (
   id 			INT 					NOT NULL AUTO_INCREMENT,
   bid 			VARCHAR(4) 				NOT NULL,
   account 		VARCHAR(20) 			NOT NULL,
   password		VARCHAR(20) 			NOT NULL,
   status 		VARCHAR(20) 			NOT NULL DEFAULT 'DISABLE',
   create_time 	DATETIME DEFAULT NOW() 	NOT NULL,
   update_time 	DATETIME DEFAULT NOW() 	NOT NULL,
   PRIMARY KEY (id),
   UNIQUE (bid, account)
);

CREATE TABLE SKI.MGNT_FUNCTION (
	id 				INT 			NOT NULL AUTO_INCREMENT,
	code 			VARCHAR(6) 		NOT NULL,
    name			VARCHAR(40) 	NOT NULL,
    path			VARCHAR(30) 	NOT NULL,
	PRIMARY KEY (id),
	UNIQUE (code, path)
);

CREATE TABLE SKI.MGNT_ADMIN_FUNCTION (
	id 			INT 				NOT NULL AUTO_INCREMENT,
	bid 		VARCHAR(4) 			NOT NULL,
    func_code	VARCHAR(10) 		NOT NULL,
	PRIMARY KEY (id),
    UNIQUE (bid, func_code)
);

CREATE TABLE SKI.MGNT_VENDOR (
	id 				INT 							NOT NULL AUTO_INCREMENT,
	bid 			VARCHAR(4) 						NOT NULL,
    name			VARCHAR(20)						NOT NULL,
    status			VARCHAR(20)	DEFAULT 'DISABLE'	NOT NULL,
	create_time 	DATETIME DEFAULT NOW() 			NOT NULL,
	update_time 	DATETIME DEFAULT NOW() 			NOT NULL,
	PRIMARY KEY (id),
    UNIQUE (bid)
);

CREATE TABLE SKI.MGNT_VENDOR_DETAIL (
	id 					INT 							NOT NULL AUTO_INCREMENT,
	bid 				VARCHAR(4) 						NOT NULL,
    company_no			VARCHAR(30)						,
	address				VARCHAR(150)					,
    bank_account		VARCHAR(50)						,
    principal			VARCHAR(30)						,
    web_site			VARCHAR(100)					,		
    contact_person 		VARCHAR(30)						,
    contact_email 		VARCHAR(30)						,
    contact_number		VARCHAR(20)						,
    remark				VARCHAR(1000)					,
    update_time			DATETIME DEFAULT NOW() 			NOT NULL,
	PRIMARY KEY (id),
    UNIQUE (bid)
);

-- INIT mgnt admin
INSERT INTO SKI.MGNT_ADMIN VALUES (
	last_insert_id(),
    'XXXX',
    'admin',
    '123456',
    'ENABLE',
    now(),
    now()
);

-- mgnt function
INSERT INTO SKI.MGNT_FUNCTION VALUES 
(last_insert_id(), 'F00001', '廠商管理', '/vendor/search.php'),
(last_insert_id(), 'F00002', '基本資料', '/vendor_info.php')
;

-- mgnt admin function
INSERT INTO SKI.MGNT_ADMIN_FUNCTION VALUES (
	last_insert_id(),
    'XXXX',
    'F00001'
);

-- init vendor marval
INSERT INTO MGNT_VENDOR VALUES (
	last_insert_id(),
    'MAVL',
    '復仇者聯盟',
    'ENABLE',
    now(),
    now()
);

-- init vendor detail marval
INSERT INTO MGNT_VENDOR_DETAIL(id, bid) VALUES (
	last_insert_id(),
    'MAVL'
);