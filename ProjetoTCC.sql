CREATE DATABASE projectTCC;
USE projectTCC;



-- drop database joao;
CREATE TABLE Acesso ( -- OK
  Idacesso INT AUTO_INCREMENT PRIMARY KEY,
  IdUnidade INT,
  IdEnfermeiro INT,
  ativo INT NULL
);

-- drop table Raca;

CREATE TABLE Enfermeiro ( -- OK
  IdEnfermeiro INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  IdFuncao INT NOT NULL,
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
IdTipoUnidade INT NOT NULL
);
INSERT INTO UnidadedeSaude (nome, telefone, tipoUnidade, rua, bairro, num, cep, IdTipoUnidade) VALUES 
('UBS Caieiras Central', '(11) 4444-1234', 'Unidade Básica de Saúde', 'Rua Central', 'Centro', '100', '07700000', 1);

INSERT INTO UnidadedeSaude (nome, telefone, tipoUnidade, rua, bairro, num, cep, IdTipoUnidade) VALUES 
('UBS Franco da Rocha Norte', '(11) 4445-5678', 'Unidade Básica de Saúde', 'Avenida Principal', 'Norte', '200', '07800000', 1);

INSERT INTO UnidadedeSaude (nome, telefone, tipoUnidade, rua, bairro, num, cep, IdTipoUnidade) VALUES 
('UBS Francisco Morato Sul', '(11) 4446-9101', 'Unidade Básica de Saúde', 'Rua dos Médicos', 'Sul', '300', '07900000', 1);

CREATE TABLE TipoUnidade( -- OK
IdTipoUnidade INT AUTO_INCREMENT PRIMARY KEY,
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
  IdGestante INT
);


CREATE TABLE Gestante( -- OK
IdGestante INT AUTO_INCREMENT PRIMARY KEY,
gestacao VARCHAR(30) NOT NULL
);
INSERT INTO Gestante (gestacao)
    VALUES ('1º Trimestre'), ('2º Trimestre'), ('3º Trimestre'), ('Ignorado'), ('Não'), ('Não se aplica');

CREATE TABLE Endereco( -- OK
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

CREATE TABLE Municipio ( -- OK
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

CREATE TABLE Exame ( -- OK
  IdExame INT AUTO_INCREMENT PRIMARY KEY,
  data_Exame date,
  IdResultado INT,
  IdTipo INT
);
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


CREATE TABLE Sorotipo ( -- OK
IdSorotipo INT AUTO_INCREMENT PRIMARY KEY,
tipo VARCHAR(10) NOT NULL
);
INSERT INTO Sorotipo (tipo) VALUES 
('DENV1'),
('DENV2'),
('DENV3'),
('DENV4');




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
  IdEscolaridade INT AUTO_INCREMENT PRIMARY KEY,
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
CREATE TABLE Conclusao ( -- OK
  IdConclusao INT AUTO_INCREMENT PRIMARY KEY,
  data_Encr DATE,
  IdEvolucao INT,
  IdCriterio INT,     
  data_Obt DATE,
  IdClass INT,
  IdApresen INT    
);

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

CREATE TABLE Criterio( -- OK
IdCriterio INT AUTO_INCREMENT PRIMARY KEY,
confirmacao VARCHAR (40) NOT NULL
);
INSERT INTO Criterio (confirmacao)
VALUES 
    ('Laboratório'),
    ('Clínico Epidemiológico'),
    ('Em investigação');
    
CREATE TABLE Apresentacao( -- OK
IdApresen INT AUTO_INCREMENT PRIMARY KEY,
clinica VARCHAR (40) NOT NULL
);
INSERT INTO Apresentacao (clinica)
VALUES 
    ('Aguda '),
    ('Crônica');


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
    
CREATE TABLE Hospitalizacao ( -- OK
  IdHospital INT AUTO_INCREMENT PRIMARY KEY,
  hospitalizacao VARCHAR(15) NOT NULL, -- Essa parte é a sim, não ou ignorada 
  data_Inter DATE,
  IdConsulta INT, 
  IdUnidade INT
);

 
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
CREATE TABLE Doenca ( -- OK
IdDoenca INT AUTO_INCREMENT PRIMARY KEY,
doenca varchar (50) NOT NULL
); -- Essa etapa identifica qual doença é, sendo dengue o chchikungunya
INSERT INTO Doenca (doenca) VALUES
('chikungunya'), ('Dengue');

CREATE TABLE Sinais_Cli ( -- OK
IdSinais INT AUTO_INCREMENT PRIMARY KEY,
doenca varchar (50) NOT NULL
); -- Sintomas que o paciente está tendo.
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
    
CREATE TABLE Dengue_Grave(
IdDengue INT AUTO_INCREMENT PRIMARY KEY,
IdAlarme INT,
data_sinais date,
data_sinais_graves date
);
CREATE TABLE Dengue_Sinais(
IdAlarme INT AUTO_INCREMENT PRIMARY KEY,
sinais_alarme VARCHAR (50) NOT NULL
);
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

CREATE TABLE Dengue_Plasma(
IdPlasma INT AUTO_INCREMENT PRIMARY KEY,
sinais_graves VARCHAR (50) NOT NULL
);
INSERT INTO Dengue_Plasma (sinais_graves) VALUES
('Pulso débil ou indetectável'),
('PA convergente <= 20 mmHg'),
('Tempo de enchimento capilar'),
('Acúmulo de líquidos com insuficiência respiratória'),
('Taquicardia'),
('Extremidades frias'),
('Hipotensão arterial em fase tardia');

CREATE TABLE Dengue_Sancramento(
IdSacramento INT AUTO_INCREMENT PRIMARY KEY,
sancramento VARCHAR (50) NULL
);
INSERT INTO Dengue_Sancramento (sancramento) VALUES
('Hematêmese '),
('Melena'),
('Metrorragia volumosa'),
('Sangramento do SNC');

CREATE TABLE Dengue_Orgao(
IdOrgao INT AUTO_INCREMENT PRIMARY KEY,
sinais_orgaos VARCHAR (150) NOT NULL
);

CREATE TABLE Zona (  -- OK
  IdZona INT AUTO_INCREMENT PRIMARY KEY,
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

