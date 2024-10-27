CREATE DATABASE bd_dengue_att2;
USE bd_dengue_att2;

-- drop database joao;
CREATE TABLE Acesso ( -- OK
  idacesso INT AUTO_INCREMENT PRIMARY KEY,
  IdUnidade INT,
  IdEnfermeiro INT,
  ativo INT NULL
);


-- drop table Raca;

CREATE TABLE Enfermeiro ( -- OK
  Id_Enfermeiro INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  idFuncao INT NOT NULL,
  coren VARCHAR(20) NOT NULL UNIQUE,
  login VARCHAR(50) NOT NULL UNIQUE,
  senha VARCHAR(30) NOT NULL,
  nivelAcesso varchar(50) NOT NULL
);
CREATE TABLE UnidadedeSaude( -- OK
IdUnidade INT AUTO_INCREMENT PRIMARY KEY,
nome varchar (120) NOT NULL,
telefone varchar(14) NOT NULL,
tipoUnidade varchar(30) NOT NULL,
rua varchar (80) NOT NULL,
bairro varchar (80) NOT NULL,
num varchar(5) NOT NULL,
cep varchar (8) NOT NULL,
idTipoUnidade INT NOT NULL
);
INSERT INTO UnidadedeSaude (nome, telefone, tipoUnidade, rua, bairro, num, cep, idTipoUnidade) VALUES 
('UBS Caieiras Central', '(11) 4444-1234', 'Unidade Básica de Saúde', 'Rua Central', 'Centro', '100', '07700000', 1);

INSERT INTO UnidadedeSaude (nome, telefone, tipoUnidade, rua, bairro, num, cep, idTipoUnidade) VALUES 
('UBS Franco da Rocha Norte', '(11) 4445-5678', 'Unidade Básica de Saúde', 'Avenida Principal', 'Norte', '200', '07800000', 1);

INSERT INTO UnidadedeSaude (nome, telefone, tipoUnidade, rua, bairro, num, cep, idTipoUnidade) VALUES 
('UBS Francisco Morato Sul', '(11) 4446-9101', 'Unidade Básica de Saúde', 'Rua dos Médicos', 'Sul', '300', '07900000', 1);

CREATE TABLE TipoUnidade( -- OK
idTipoUnidade INT AUTO_INCREMENT PRIMARY KEY,
tipoUnidade varchar(50) NOT NULL,
IdMunicipio INT NOT NULL
);
INSERT INTO TipoUnidade (tipoUnidade, IdMunicipio)
VALUES
('UBS','2'),
('UPA','5'),
('UBS','3'),
('UPA','1');

CREATE TABLE Funcoes (-- Necessario entender o porque que ela existe com André
  IdFuncao INT AUTO_INCREMENT PRIMARY KEY,
  funcao VARCHAR(100) NOT NULL
);
INSERT INTO Funcoes (Funcao)
VALUES
('Enfermeiro'),
('Enfermeiro Chefe'),
('Gerente'),
('Agente Vigilância Epidemiologica');
CREATE TABLE Local_infeccao ( -- Ta certa
  IdLocal INT AUTO_INCREMENT PRIMARY KEY,
  pais VARCHAR(30) NOT NULL,
  estado VARCHAR(40) NOT NULL,
  municipio VARCHAR(80) NULL,
  bairro VARCHAR(80) NULL,
  idConsulta INT
);
-- -----------------------------------------------------------EXECUTADO COM SUCESSO ------------------------------------------------------------------
CREATE TABLE Paciente (
  IdPaciente INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120)NOT NULL,
  cartao_SUS VARCHAR(20) NULL,
  cpf varchar(14) NOT NULL,
  nome_Mae VARCHAR(100)NOT NULL,
  data_Nasc date NOT NULL,
  idade INT,
  ocupacao VARCHAR(100),
  IdGenero INT NOT NULL,
  IdRaca INT NOT NULL
);
CREATE TABLE Endereco(
  IdEndereco INT AUTO_INCREMENT PRIMARY KEY,
  rua VARCHAR(150) NULL,
  bairro VARCHAR(100) NULL,
  num_Res VARCHAR(4) NULL,
  cep varchar (8) NOT NULL,
  ponto_Ref VARCHAR(100) NULL,
  comple varchar (30) NULL,
  geo_camp_um varchar (25) NULL,
  geo_camp_dois varchar (25) NULL
);

CREATE TABLE UF ( -- OK
  IdUF INT AUTO_INCREMENT PRIMARY KEY,
  sigla CHAR(3) NOT NULL
);
INSERT INTO UF (sigla)
    VALUES ('SP');

CREATE TABLE Municipio (
  IdMunicipio INT AUTO_INCREMENT PRIMARY KEY,
  codigoIBGE INT,
  cidade VARCHAR(50) NOT NULL
);
INSERT INTO Municipio (codigoIBGE, cidade)
    VALUES
    ( '3516408', 'Franco da Rocha'),
    ('3509007','Caieiras'),
    ('3516309','Francisco Morato'),
    ('3528502','Mairiporã'),
    ('3509205','Cajamar');
    
-- drop table municipio;

CREATE TABLE Genero ( -- OK
  IdGenero INT AUTO_INCREMENT PRIMARY KEY,
  sexo VARCHAR(15) NOT NULL
);
 INSERT INTO Genero (sexo)
    VALUES
    ('Masculino'), ('Feminino');


CREATE TABLE Raca (  -- OK
  IdRaca INT AUTO_INCREMENT PRIMARY KEY,
  raca VARCHAR (25) NOT NULL
);
INSERT INTO Raca (raca) VALUES 
('Branca'),
('Preta'),
('Parda'),
('Amarela'),
('Indígena'),
('Ignorada');

CREATE TABLE Exame (
  Id_ExamePK INT AUTO_INCREMENT PRIMARY KEY,
  tipoExame VARCHAR(255), 
  Id_Consulta INT
);


CREATE TABLE DoencasPre_exist (  -- OK
  IdDoenca INT AUTO_INCREMENT PRIMARY KEY,
  doenca_PreExistentes VARCHAR(50) NOT NULL
);
INSERT INTO DoencasPre_exist (Doenca_PreExistentes) VALUES 
('Diabetes'),
('Hepatopatias'),
('Hipertensão arterial'),
('Doenças auto-imunes'),
('Doenças hematológicas'),
('Doença renal crônica'),
('Doença ácido-péptica');

-- Tabela Escolaridade
CREATE TABLE Escolaridade ( -- OK
  idEscolaridade INT AUTO_INCREMENT PRIMARY KEY,
  formacao varchar (30) NOT NULL
);
INSERT INTO Escolaridade (formacao)
VALUES 
    ('Analfabeto'),
    ('1ª a 4ª série incompleta'),
    ('4ª série completa'),
    ('5ª à 8ª série incompleta'),
    ('Ensino fundamental completo'),
    ('Ensino médio incompleto'),
    ('Ensino médio completo'),
    ('Educação superior incompleta'),
    ('Educação superior completa'),
    ('Ignorado'),
    ('Não se aplica');

-- Tabela Agravo
CREATE TABLE Agravo (
  IdAgravo INT AUTO_INCREMENT PRIMARY KEY,
  data_Encr DATE,
  apres_Clinica VARCHAR(140),  
  confirmacao VARCHAR(50),     
  data_Obt DATE,
  evolucao_Caso VARCHAR(255),   
  doenca VARCHAR(80),           
  Id_Consulta INT
);


CREATE TABLE Hospitalizacao (
  Id_HospitalPK INT AUTO_INCREMENT PRIMARY KEY,
  data_Inter DATE,
  id_consulta INT, 
  Id_Unidade INT
);

CREATE TABLE Consulta (
  Id_ConsultaPK INT AUTO_INCREMENT PRIMARY KEY,
  Id_Paciente INT,
  Id_Enfermeiro INT,
  ID_UniSaude INT,
  Id_UF INT,
  Id_municipio INT,
  cid INT,
  data_Notificacao DATE,
  doenca INT,
  -- Sinais_Clinicos INT, isso vira tabela 
  data_Investigacao DATE,
  observacoes TEXT
);

CREATE TABLE Sinais_Cli ( -- OK
Id_Sinais INT AUTO_INCREMENT PRIMARY KEY,
doenca varchar (50) NOT NULL
);
INSERT INTO Sinais_Cli (doenca) VALUES 
	('Febre'),
	('Cefaleia'),
	('Vômito'),
	('Dor nas costas'),
	('Artrite'),
	('Petéquias'),
	('Prova do laço positiva'),
	('Mialgia'),
	('Exantema'),
	('Náuseas'),
	('Conjuntivite'),
	('Artralgia intensa'),
	('Leucopenia'),
	('Dor retroorbital');


CREATE TABLE Zona (  -- OK
  idZona INT AUTO_INCREMENT PRIMARY KEY,
  zona varchar(30) NULL
);
 INSERT INTO Zona (zona)
    VALUES 
    ('Urbana'), ('Rural'), ('Periurbana'), ('Ignorado');
    
   
    
   
    
	

-- Adicionando chaves estrangeiras no final

ALTER TABLE Agravo
  ADD CONSTRAINT fk_Agravo_idConsulta FOREIGN KEY (Id_Consulta) REFERENCES Consulta(Id_ConsultaPK);

ALTER TABLE Exame
  ADD CONSTRAINT fk_Exame_idConsulta FOREIGN KEY (Id_Consulta) REFERENCES Consulta(Id_ConsultaPK);

ALTER TABLE DoencasPre_exist
  ADD CONSTRAINT fk_DoencasPre_idPaciente FOREIGN KEY (Id_Paciente) REFERENCES Paciente(Id_PacientePK);

 -- ALTER TABLE Escolaridade
  -- ADD CONSTRAINT fk_Escolaridade_idPaciente FOREIGN KEY (Id_Paciente) REFERENCES Paciente(Id_PacientePK); Nessa etapa foi alterada para ter ligação com outra tabelas 

ALTER TABLE Hospitalizacao
  ADD CONSTRAINT fk_Hospitalizacao_idConsulta FOREIGN KEY (id_consulta) REFERENCES Consulta(Id_ConsultaPK);

ALTER TABLE Consulta
  ADD CONSTRAINT fk_Consulta_idPaciente FOREIGN KEY (Id_Paciente) REFERENCES Paciente(Id_PacientePK);



ALTER TABLE Consulta
  ADD CONSTRAINT fk_Consulta_Id_UF FOREIGN KEY (Id_UF) REFERENCES UF(Id_UF);

ALTER TABLE Consulta
  ADD CONSTRAINT fk_Consulta_Id_municipio FOREIGN KEY (Id_municipio) REFERENCES Municipio(Id_municipioPK);

ALTER TABLE Consulta
  ADD CONSTRAINT fk_Consulta_Id_Hosp FOREIGN KEY (Id_Hosp) REFERENCES Hospitalizacao(Id_HospitalPK);

ALTER TABLE Zona
  ADD CONSTRAINT fk_Zona_idPaciente FOREIGN KEY (Id_Paciente) REFERENCES Paciente(Id_PacientePK);

ALTER TABLE Genero
  ADD CONSTRAINT fk_Genero_idPaciente FOREIGN KEY (Id_Paciente) REFERENCES Paciente(Id_PacientePK);

ALTER TABLE Raca
  ADD CONSTRAINT fk_Raca_idPaciente FOREIGN KEY (Id_Paciente) REFERENCES Paciente(Id_PacientePK);
  
ALTER TABLE Enfermeiro
  ADD CONSTRAINT fk_Enfermeiro_idFuncao FOREIGN KEY (id_Funcao) REFERENCES Funcoes(id_Funcao);
  
  ALTER TABLE Consulta
  ADD CONSTRAINT fk_Consulta_idEnfermeiro FOREIGN KEY (Id_Enfermeiro) REFERENCES Enfermeiro(Id_Enfermeiro);
  

ALTER TABLE Acesso
  ADD CONSTRAINT fk_Acesso_idEnfermeiro FOREIGN KEY (idenfermeiro) REFERENCES Enfermeiro(Id_Enfermeiro);
  
  ALTER TABLE Local_infeccao
  ADD CONSTRAINT fk_LocalInfeccao_idConsulta FOREIGN KEY (idConsulta) REFERENCES Consulta(Id_ConsultaPK);

ALTER TABLE Acesso
  ADD CONSTRAINT fk_Acesso_idUnidade FOREIGN KEY (idunidade) REFERENCES Municipio(Id_municipioPK);

ALTER TABLE Consulta
  ADD CONSTRAINT fk_Consulta_ID_UniSaude FOREIGN KEY (ID_UniSaude) REFERENCES Municipio(Id_municipioPK);

