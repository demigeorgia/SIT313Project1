drop table dates;

create table dates
(DATEOFENTRY NVARCHAR2(20) NOT NULL,
TEXTINPUTONE NVARCHAR2(100),
TEXTINPUTTWO NVARCHAR2(100),
TEXTINPUTTHREE NVARCHAR2(14),
SAD NVARCHAR2(3),
ANGRY NVARCHAR2(5),
HAPPY NVARCHAR2(5),
WORRIED NVARCHAR2(7),
SMITTEN NVARCHAR2(7),
STRESSED NVARCHAR2(8),
PRIMARY KEY (DATEOFENTRY));

COMMIT;
