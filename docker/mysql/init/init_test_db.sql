-- Crée la base de données pour les tests
CREATE DATABASE IF NOT EXISTS test_technique_test;

-- Donne tous les privilèges à l'utilisateur mathieu sur cette base
GRANT ALL PRIVILEGES ON test_technique_test.* TO 'mathieu'@'%';
FLUSH PRIVILEGES;
