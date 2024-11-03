CREATE DATABASE projeto_tcc;
USE projeto_tcc;



-- drop database joao;

-- tabelas com informaçoes basicas, organizadas por nivel de dependencia --


CREATE TABLE UF ( -- OK
  IdUF INT AUTO_INCREMENT PRIMARY KEY,
  sigla CHAR(3) NOT NULL
);
INSERT INTO UF (sigla)
    VALUES ('SP');

CREATE TABLE Municipio ( -- OK
  IdMunicipio INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  codigoIBGE INT,
  cidade VARCHAR(50) NOT NULL
);

CREATE TABLE TipoUnidade( -- OK
IdTipoUnidade INT AUTO_INCREMENT PRIMARY KEY,
tipoUnidade varchar(50) NOT NULL,
IdMunicipio INT NOT NULL
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
IdTipoUnidade INT NOT NULL
);

CREATE TABLE Funcoes (-- Necessario entender o porque que ela existe com André
  IdFuncao INT AUTO_INCREMENT PRIMARY KEY,
  funcao VARCHAR(100) NOT NULL
);

CREATE TABLE Enfermeiro ( -- OK
  IdEnfermeiro INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  IdFuncao INT NOT NULL,
  coren VARCHAR(20) NOT NULL UNIQUE,
  login VARCHAR(50) NOT NULL UNIQUE,
  senha VARCHAR(30) NOT NULL,
  nivelAcesso varchar(50) NOT NULL
);

CREATE TABLE Acesso ( -- OK
  Idacesso INT AUTO_INCREMENT PRIMARY KEY,
  IdUnidade INT,
  IdEnfermeiro INT,
  ativo INT NULL
);

CREATE TABLE Local_infeccao ( -- Ta certa
  IdLocal INT AUTO_INCREMENT PRIMARY KEY,
  pais VARCHAR(30) NOT NULL,
  estado VARCHAR(40) NOT NULL,
  municipio VARCHAR(80) NULL,
  bairro VARCHAR(80) NULL,
  idConsulta INT
);

-- drop table Raca;



INSERT INTO UnidadedeSaude (nome, telefone, tipoUnidade, rua, bairro, num, cep, IdTipoUnidade) VALUES 
('UBS Caieiras Central', '(11) 4444-1234', 'Unidade Básica de Saúde', 'Rua Central', 'Centro', '100', '07700000', 1);

INSERT INTO UnidadedeSaude (nome, telefone, tipoUnidade, rua, bairro, num, cep, IdTipoUnidade) VALUES 
('UBS Franco da Rocha Norte', '(11) 4445-5678', 'Unidade Básica de Saúde', 'Avenida Principal', 'Norte', '200', '07800000', 1);

INSERT INTO UnidadedeSaude (nome, telefone, tipoUnidade, rua, bairro, num, cep, IdTipoUnidade) VALUES 
('UBS Francisco Morato Sul', '(11) 4446-9101', 'Unidade Básica de Saúde', 'Rua dos Médicos', 'Sul', '300', '07900000', 1);


INSERT INTO TipoUnidade (tipoUnidade, IdMunicipio)
VALUES
('UBS','2'),
('UPA','5'),
('UBS','3'),
('UPA','1');


INSERT INTO Funcoes (Funcao)
VALUES
('Enfermeiro'),
('Enfermeiro Chefe'),
('Gerente'),
('Agente Vigilância Epidemiologica');



INSERT INTO Municipio (codigoIBGE, cidade)
    VALUES
    ( '3516408', 'Franco da Rocha'),
    ('3509007','Caieiras'),
    ('3516309','Francisco Morato'),
    ('3528502','Mairiporã'),
    ('3509205','Cajamar');

-- tabelas de informações do paciente --

CREATE TABLE Gestante( -- OK
IdGestante INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
gestacao VARCHAR(30) NOT NULL
);
INSERT INTO Gestante (gestacao)
    VALUES ('1º Trimestre'), ('2º Trimestre'), ('3º Trimestre'), ('Ignorado'), ('Não'), ('Não se aplica');


CREATE TABLE Genero ( -- OK
  IdGenero INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  sexo VARCHAR(15) NOT NULL
);
 INSERT INTO Genero (sexo)
    VALUES
    ('Masculino'), ('Feminino');


CREATE TABLE Raca (  -- OK
  IdRaca INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  raca VARCHAR (25) NOT NULL
);
INSERT INTO Raca (raca) VALUES 
('Branca'),
('Preta'),
('Parda'),
('Amarela'),
('Indígena'),
('Ignorada');


CREATE TABLE Escolaridade ( -- OK
  IdEscolaridade INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
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


CREATE TABLE Endereco( -- OK
  IdEndereco INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  rua VARCHAR(150) NULL,
  bairro VARCHAR(100) NULL,
  num_Res VARCHAR(4) NULL,
  cep varchar (8) NOT NULL,
  ponto_Ref VARCHAR(100) NULL,
  comple varchar (30) NULL,
  geo_camp_um varchar (25) NULL,
  geo_camp_dois varchar (25) NULL,
  IdMunicipio INT NOT NULL,
  FOREIGN KEY (IdMunicipio) REFERENCES Municipio(IdMunicipio)
);



-------- Area de Doeças e sinais clinicos --------

CREATE TABLE Doencas_Pre_Exist (  -- OK
  IdDoencaPE INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  Doenca_Pre_Existentes VARCHAR(50) NOT NULL
);


CREATE TABLE Sinais_Cli ( -- OK
  IdSinais INT AUTO_INCREMENT PRIMARY KEY,
  doenca varchar (50) NOT NULL
); 


CREATE TABLE Dengue_Grave(
  IdDengue INT AUTO_INCREMENT PRIMARY KEY,
  IdGrave INT,
  data_sinais date,
  data_sinais_graves date
);


CREATE TABLE Dengue_Sinais(
IdAlarme INT AUTO_INCREMENT PRIMARY KEY,
sinais_alarme VARCHAR (50) NOT NULL
);


CREATE TABLE Dengue_Plasma(
IdPlasma INT AUTO_INCREMENT PRIMARY KEY,
sinais_plasma VARCHAR (50) NOT NULL
);

CREATE TABLE Dengue_Sangramento(
IdSang INT AUTO_INCREMENT PRIMARY KEY,
TipoSangramento VARCHAR (50) NULL
);

CREATE TABLE Dengue_Orgao(
IdOrgao INT AUTO_INCREMENT PRIMARY KEY,
sinais_orgaos VARCHAR (150) NOT NULL
);

-------- Inserção de dados nas tabelas acima --------

INSERT INTO Doencas_Pre_Exist (Doenca_Pre_Existentes) VALUES 
('Diabetes'),
('Hepatopatias'),
('Hipertensão arterial'),
('Doenças auto-imunes'),
('Doenças hematológicas'),
('Doença renal crônica'),
('Doença ácido-péptica');


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


INSERT INTO Dengue_Sinais (sinais_alarme) VALUES
('Hipotensão postural e/ou lipotímia'),
('Queda abrupta de plaquetas'),
('Vômitos persistentes'),
('Dor abdominal intensa e contínua'),
('Letargia ou irritabilidade'),
('Sangramento de mucosa/outras hemorragias'),
('Aumento progressivo do hematócrito'),
('Hepatomegalia >= 2cm'),
('Acúmulo de líquidos');


INSERT INTO Dengue_Plasma (sinais_plasma) VALUES
('Pulso débil ou indetectável'),
('PA convergente <= 20 mmHg'),
('Tempo de enchimento capilar'),
('Acúmulo de líquidos com insuficiência respiratória'),
('Taquicardia'),
('Extremidades frias'),
('Hipotensão arterial em fase tardia');

INSERT INTO Dengue_Sangramento (TipoSangramento) VALUES
('Hematêmese'),
('Melena'),
('Metrorragia volumosa'),
('Sangramento do SNC');

-- ----------------------------------------------------------- EXECUTADO COM SUCESSO ------------------------------------------------------------------
CREATE TABLE Paciente ( -- OK
  IdPaciente INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120)NOT NULL,
  cartao_SUS VARCHAR(20) NULL,
  cpf varchar(14) NOT NULL,
  nome_Mae VARCHAR(100)NOT NULL,
  data_Nasc date NOT NULL,
  idade INT,
  ocupacao VARCHAR(100),
  IdGenero INT NOT NULL,
  IdRaca INT NOT NULL,
  IdGestante INT NOT NULL,
  IdEscolaridade INT NOT NULL,
  IdEndereco INT NOT NULL,
  FOREIGN KEY (IdGenero) REFERENCES Genero(IdGenero),
  FOREIGN KEY (IdRaca) REFERENCES Raca(IdRaca),
  FOREIGN KEY (IdGestante) REFERENCES Gestante(IdGestante),
  FOREIGN KEY (IdEscolaridade) REFERENCES Escolaridade(IdEscolaridade),
  FOREIGN KEY (IdEndereco) REFERENCES Endereco(IdEndereco)
);

CREATE TABLE DPEPac (
    CodDPEPac int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    IdPaciente int NOT NULL,
    IdDoencaPE int NOT NULL,
    FOREIGN KEY (IdPaciente) REFERENCES Paciente(IdPaciente),
    FOREIGN KEY (IdDoencaPE) REFERENCES Doencas_Pre_Exist(IdDoencaPE)
);

CREATE TABLE SinaisClinicosPac(
  CodSinaisCLiPac int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  IdPaciente int NOT NULL,
  IdSinais int NOT NULL,
  FOREIGN KEY (IdPaciente) REFERENCES Paciente(IdPaciente),
  FOREIGN KEY (IdSinais) REFERENCES Sinais_Cli(IdSinais)
);

CREATE TABLE SinaisAlarmePac(
  CodSinaisAlarPac int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  IdPaciente int NOT NULL,
  IdAlarme int NOT NULL,
  FOREIGN KEY (IdPaciente) REFERENCES Paciente(IdPaciente),
  FOREIGN KEY (IdAlarme) REFERENCES Dengue_Sinais(IdAlarme)
);

CREATE TABLE SinaisPlasmaPac(
  CodSinaisPlasPac int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  IdPaciente int NOT NULL,
  IdPlasma int NOT NULL,
  FOREIGN KEY (IdPaciente) REFERENCES Paciente(IdPaciente),
  FOREIGN KEY (IdPlasma) REFERENCES Dengue_Plasma(IdPlasma)
);

CREATE TABLE SinaisSangramentoPac(
  CodSinaisSangPac int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  IdPaciente int NOT NULL,
  IdSang int NOT NULL,
  FOREIGN KEY (IdPaciente) REFERENCES Paciente(IdPaciente),
  FOREIGN KEY (IdSang) REFERENCES Dengue_Sangramento(IdSang)
);

    
-- drop table municipio;
CREATE TABLE tipo_Exame( -- OK
IdTipo INT AUTO_INCREMENT PRIMARY KEY,
tipo_Exame VARCHAR(50) NOT NULL
);
INSERT INTO tipo_Exame (tipo_Exame)
VALUES 
('PRNT'),
('NS1'),
('Isolamento'),
('RT-PCR'),
('Histopatologia'),
('Imunohistoquímica');

CREATE TABLE Resultado ( -- OK
IdResultado INT AUTO_INCREMENT PRIMARY KEY,
exame VARCHAR(50) NOT NULL,
resultado VARCHAR(30) NOT NULL
);

INSERT INTO Resultado ( resultado)
VALUES ('S1'),('S2'),('PRNT');
--   Separação de exames
INSERT INTO Resultado (resultado)
VALUES ('Positivo'),('Negativo'),('Inconclusivo'), ('Não realizado');
--   Separação de exames
INSERT INTO Resultado ( resultado)
VALUES ('Compativel'),('Incompativel'),('Inconclusivo'), ('Não realizado');


CREATE TABLE Exame ( -- OK
  IdExame INT AUTO_INCREMENT PRIMARY KEY,
  data_Exame date,
  IdResultado INT,
  IdTipo INT
);



CREATE TABLE Sorotipo ( -- OK
IdSorotipo INT AUTO_INCREMENT PRIMARY KEY,
tipo VARCHAR(10) NOT NULL
);
INSERT INTO Sorotipo (tipo) VALUES 
('DENV1'),
('DENV2'),
('DENV3'),
('DENV4');

-- tabelas de dependencias pafra conclusão --

CREATE TABLE Classificacao( -- OK
IdClass INT AUTO_INCREMENT PRIMARY KEY,
caso VARCHAR (40) NOT NULL
);
INSERT INTO Classificacao (caso)
VALUES 
    ('Descartado '),
    ('Dengue'),
    ('Dengue com Sinais de Alarme'),
    ('Dengue Grave'),
    ('Chikungunya');


CREATE TABLE Apresentacao( -- OK
IdApresen INT AUTO_INCREMENT PRIMARY KEY,
clinica VARCHAR (40) NOT NULL
);
INSERT INTO Apresentacao (clinica)
VALUES 
    ('Aguda '),
    ('Crônica');

CREATE TABLE Criterio( -- OK
IdCriterio INT AUTO_INCREMENT PRIMARY KEY,
confirmacao VARCHAR (40) NOT NULL
);
INSERT INTO Criterio (confirmacao)
VALUES 
    ('Laboratório'),
    ('Clínico Epidemiológico'),
    ('Em investigação');


CREATE TABLE Evolucao( -- OK
IdEvolucao INT AUTO_INCREMENT PRIMARY KEY,
estado VARCHAR (40) NOT NULL
);
INSERT INTO Evolucao (estado)
VALUES 
    ('Cura'),
    ('Óbito pelo agravo'),
    ('Óbito por outras causas'),
    ('Óbito em investigação'),
    ('Ignorado');


-- Tabela Agravo
CREATE TABLE Conclusao ( -- OK
  IdConclusao INT AUTO_INCREMENT PRIMARY KEY,
  data_Encr DATE,
  IdEvolucao INT,
  IdCriterio INT,     
  data_Obt DATE,
  IdClass INT,
  IdApresen INT    
);
    
CREATE TABLE Hospitalizacao ( -- OK
  IdHospital INT AUTO_INCREMENT PRIMARY KEY,
  hospitalizacao VARCHAR(15) NOT NULL, -- Essa parte é a sim, não ou ignorada 
  data_Inter DATE,
  IdConsulta INT, 
  IdUnidade INT
);

CREATE TABLE Doenca ( -- OK
IdDoenca INT AUTO_INCREMENT PRIMARY KEY,
doenca varchar (50) NOT NULL
); -- Essa etapa identifica qual doença é, sendo dengue o chchikungunya
INSERT INTO Doenca (doenca) VALUES
('chikungunya'), ('Dengue');

CREATE TABLE Zona (  -- OK
  IdZona INT AUTO_INCREMENT PRIMARY KEY,
  zona varchar(30) NULL
);


 INSERT INTO Zona (zona)
    VALUES 
    ('Urbana'), ('Rural'), ('Periurbana'), ('Ignorado');

 
CREATE TABLE Consulta ( -- OK
  IdConsulta INT AUTO_INCREMENT PRIMARY KEY,
  IdPaciente INT,
  IdEnfermeiro INT,
  IdUnidade INT,
  IdUF INT,
  IdMunicipio INT,
  IdExame INT,
  IdSorotipo INT,
  IdResultado INT,
  IdTipo INT,
  IdDoenca INT,
  IdSinais INT,
  IdLocal INT,
  IdZona INT,
  cid INT,
  tipo_not varchar (15) NOT NULL, -- Individual
  data_Notificacao DATE,
  autoctone VARCHAR (15) NOT NULL,
  data_Investigacao DATE,
  observacoes TEXT
);