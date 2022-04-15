drop table if EXISTS user;
create TABLE `user` (
`id` int UNSIGNED not NULL auto_increment comment 'ID',
`name` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '姓名',
`gender` TINYINT NOT NULL DEFAULT 0 COMMENT '性别（0男 1女）',
`create_at` datetime not NULL default CURRENT_TIMESTAMP COMMENT '创建时间',
PRIMARY KEY (`id`) using BTREE
) ENGINE=INNODB Auto_increment=10001 comment='测试用户表';

INSERT into user VALUES(10001, '章三', 0, CURRENT_TIMESTAMP);
INSERT into user VALUES(10002, '里斯', 1, CURRENT_TIMESTAMP);