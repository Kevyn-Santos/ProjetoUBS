CREATE DATABASE bd_dengue_att;
USE bd_dengue_att;


CREATE TABLE Acesso (
  idacesso INT AUTO_INCREMENT PRIMARY KEY,
  idunidade INT,
  idenfermeiro INT
);

CREATE TABLE Enfermeiro (
  Id_Enfermeiro INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(200) NOT NULL,
  id_Funcao INT NOT NULL,
  coren VARCHAR(20) NOT NULL UNIQUE,
  login VARCHAR(50) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  nivelAcesso ENUM('Usuario', 'Administrador') NOT NULL  -- Ajuste do nível de acesso
);

-- Tabela Funcoes
CREATE TABLE Funcoes (
  id_Funcao INT AUTO_INCREMENT PRIMARY KEY,
  funcao VARCHAR(100) NOT NULL
);
CREATE TABLE Local_infeccao (
  id_local INT AUTO_INCREMENT PRIMARY KEY,
  Pais VARCHAR(30) NOT NULL,
  Estado VARCHAR(40) NOT NULL,
  Municipio VARCHAR(80) NULL,
  Bairro VARCHAR(80) NULL,
  idConsulta INT
);
-- -----------------------------------------------------------EXECUTADO COM SUCESSO ------------------------------------------------------------------
CREATE TABLE Paciente (
  Id_PacientePK INT AUTO_INCREMENT PRIMARY KEY,
  Cartao_SUS VARCHAR(20),
  Nome_Mae VARCHAR(100),
  idGestante INT,
  Rua VARCHAR(150),
  Bairro VARCHAR(100),
  Num_Res VARCHAR(4),
  Nome VARCHAR(100),
  Idade INT,
  Ocupacao VARCHAR(100),
  idGenero INT,
  idRaca INT
);


CREATE TABLE UF (
  Id_UF INT AUTO_INCREMENT PRIMARY KEY,
  sigla CHAR(3) NOT NULL
);


CREATE TABLE Municipio (
  Id_municipioPK INT AUTO_INCREMENT PRIMARY KEY,
  CodigoIBGE INT,
  NomeMunicipio VARCHAR(100)
);


CREATE TABLE Genero (
  Id_Genero INT AUTO_INCREMENT PRIMARY KEY,
  sexo VARCHAR(10) NOT NULL,
  Id_Paciente INT NOT NULL
);


CREATE TABLE Raca (
  Id_Raca INT AUTO_INCREMENT PRIMARY KEY,
  Id_Paciente INT NOT NULL
);

CREATE TABLE Exame (
  Id_ExamePK INT AUTO_INCREMENT PRIMARY KEY,
  tipoExame VARCHAR(255), 
  Id_Consulta INT
);


CREATE TABLE DoencasPre_exist (
  Id_DoencaPK INT AUTO_INCREMENT PRIMARY KEY,
  Id_Paciente INT, 
  Doenca_PreExistentes VARCHAR(150)
);

-- Tabela Escolaridade
CREATE TABLE Escolaridade (
  idEscolaridadePK INT AUTO_INCREMENT PRIMARY KEY,
  escolaridade ENUM('Analfabeto', '1ª a 4ª série incompleta', '4ª série completa', 
                    '5ª à 8ª série incompleta', 'Ensino fundamental completo', 
                    'Ensino médio incompleto', 'Ensino médio completo', 
                    'Educação superior incompleta', 'Educação superior completa', 
                    'Ignorado', 'Não se aplica') NOT NULL,
  Id_Paciente INT NOT NULL
);

-- Tabela Agravo
CREATE TABLE Agravo (
  Id_AgravoPK INT AUTO_INCREMENT PRIMARY KEY,
  Data_Encr DATE,
  Apres_Clinica VARCHAR(140),  
  Confirmacao VARCHAR(50),     
  Data_Obt DATE,
  Evolucao_Caso VARCHAR(255),   
  Doenca VARCHAR(80),           
  Id_Consulta INT
);


CREATE TABLE Hospitalizacao (
  Id_HospitalPK INT AUTO_INCREMENT PRIMARY KEY,
  Data_Inter DATE,
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
  Id_Hosp INT,
  CID INT,
  Data_Notificacao DATE,
  Doenca INT,
  Sinais_Clinicos INT,
  DT_Investigacao DATE,
  Observacoes TEXT
);


CREATE TABLE Zona (
  idZona INT AUTO_INCREMENT PRIMARY KEY,
  zona ENUM('Urbana', 'Rural', 'Periurbana', 'Ignorado') NULL,
  Id_Paciente INT NOT NULL
);

-- Adicionando chaves estrangeiras no final

ALTER TABLE Agravo
  ADD CONSTRAINT fk_Agravo_idConsulta FOREIGN KEY (Id_Consulta) REFERENCES Consulta(Id_ConsultaPK);

ALTER TABLE Exame
  ADD CONSTRAINT fk_Exame_idConsulta FOREIGN KEY (Id_Consulta) REFERENCES Consulta(Id_ConsultaPK);

ALTER TABLE DoencasPre_exist
  ADD CONSTRAINT fk_DoencasPre_idPaciente FOREIGN KEY (Id_Paciente) REFERENCES Paciente(Id_PacientePK);

ALTER TABLE Escolaridade
  ADD CONSTRAINT fk_Escolaridade_idPaciente FOREIGN KEY (Id_Paciente) REFERENCES Paciente(Id_PacientePK);

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

