<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200509172056 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE absence_historical (id INT AUTO_INCREMENT NOT NULL, absence_id INT DEFAULT NULL, realized_by_id INT DEFAULT NULL, absence_state VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_A66171002DFF238F (absence_id), INDEX IDX_A66171001ECF8E19 (realized_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE absence_historical ADD CONSTRAINT FK_A66171002DFF238F FOREIGN KEY (absence_id) REFERENCES absence (id)');
        $this->addSql('ALTER TABLE absence_historical ADD CONSTRAINT FK_A66171001ECF8E19 FOREIGN KEY (realized_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE absence_historical');
    }
}
