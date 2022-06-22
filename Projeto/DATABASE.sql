CREATE TABLE sbd."LIVRO" (
	"Cod_livro" serial NOT NULL UNIQUE,
	"Titulo" VARCHAR(45) NOT NULL UNIQUE,
	"Nome_editora" VARCHAR(50) NOT NULL,
	"Nome_autor" VARCHAR(64) NOT NULL,
	CONSTRAINT "LIVRO_pk" PRIMARY KEY ("Cod_livro","Titulo")
) WITH (
  OIDS=FALSE
);



CREATE TABLE sbd."LIVRO_AUTOR" (
	"Cod_autor" serial NOT NULL,
	"Nome" VARCHAR(50) NOT NULL,
	CONSTRAINT "LIVRO_AUTOR_pk" PRIMARY KEY ("Cod_autor","Nome")
) WITH (
  OIDS=FALSE
);



CREATE TABLE sbd."EDITORA" (
	"Nome" VARCHAR(50) NOT NULL UNIQUE,
	"Endereco" VARCHAR(100) NOT NULL,
	"Telefone" VARCHAR(15) NOT NULL,
	"Cod_editora" serial NOT NULL,
	CONSTRAINT "EDITORA_pk" PRIMARY KEY ("Nome","Cod_editora")
) WITH (
  OIDS=FALSE
);



CREATE TABLE sbd."LIVRO_COPIAS" (
	"Cod_livro" integer NOT NULL,
	"Cod_unidade" integer NOT NULL,
	"Qt_copia" integer NOT NULL,
	CONSTRAINT "LIVRO_COPIAS_pk" PRIMARY KEY ("Cod_livro","Cod_unidade")
) WITH (
  OIDS=FALSE
);



CREATE TABLE sbd."LIVRO_EMPRESTIMO" (
	"Cod_livro" integer NOT NULL,
	"Cod_unidade" integer NOT NULL,
	"Num_cartao" integer NOT NULL,
	"Data_emprestimo" DATE NOT NULL,
	"Data_devolucao" DATE NOT NULL,
	CONSTRAINT "LIVRO_EMPRESTIMO_pk" PRIMARY KEY ("Cod_livro","Cod_unidade","Num_cartao")
) WITH (
  OIDS=FALSE
);



CREATE TABLE sbd."UNIDADE_BIBLIOTECA" (
	"Cod_unidade" serial NOT NULL UNIQUE,
	"Nome" VARCHAR(45) NOT NULL,
	"Endereco" VARCHAR(60) NOT NULL,
	CONSTRAINT "UNIDADE_BIBLIOTECA_pk" PRIMARY KEY ("Cod_unidade","Nome")
) WITH (
  OIDS=FALSE
);



CREATE TABLE sbd."USUARIO" (
	"Num_cartao" serial NOT NULL UNIQUE,
	"Nome" VARCHAR(45) NOT NULL UNIQUE,
	"Endereco" VARCHAR(100) NOT NULL,
	"Telefone" VARCHAR(10) NOT NULL UNIQUE,
	CONSTRAINT "USUARIO_pk" PRIMARY KEY ("Num_cartao","Nome")
) WITH (
  OIDS=FALSE
);



ALTER TABLE "LIVRO" ADD CONSTRAINT "LIVRO_fk0" FOREIGN KEY ("Nome_editora") REFERENCES "EDITORA"("Nome");
ALTER TABLE "LIVRO" ADD CONSTRAINT "LIVRO_fk1" FOREIGN KEY ("Nome_autor") REFERENCES "LIVRO_AUTOR"("Nome");



ALTER TABLE "LIVRO_COPIAS" ADD CONSTRAINT "LIVRO_COPIAS_fk0" FOREIGN KEY ("Cod_livro") REFERENCES "LIVRO"("Cod_livro");
ALTER TABLE "LIVRO_COPIAS" ADD CONSTRAINT "LIVRO_COPIAS_fk1" FOREIGN KEY ("Cod_unidade") REFERENCES "UNIDADE_BIBLIOTECA"("Cod_unidade");

ALTER TABLE "LIVRO_EMPRESTIMO" ADD CONSTRAINT "LIVRO_EMPRESTIMO_fk0" FOREIGN KEY ("Cod_livro") REFERENCES "LIVRO"("Cod_livro");
ALTER TABLE "LIVRO_EMPRESTIMO" ADD CONSTRAINT "LIVRO_EMPRESTIMO_fk1" FOREIGN KEY ("Cod_unidade") REFERENCES "UNIDADE_BIBLIOTECA"("Cod_unidade");
ALTER TABLE "LIVRO_EMPRESTIMO" ADD CONSTRAINT "LIVRO_EMPRESTIMO_fk2" FOREIGN KEY ("Num_cartao") REFERENCES "USUARIO"("Num_cartao");









