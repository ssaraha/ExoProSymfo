<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220303060700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transfer ADD from_club_id INT DEFAULT NULL, ADD to_club_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transfer ADD CONSTRAINT FK_4034A3C0E747E99D FOREIGN KEY (from_club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE transfer ADD CONSTRAINT FK_4034A3C0EF8137C7 FOREIGN KEY (to_club_id) REFERENCES club (id)');
        $this->addSql('CREATE INDEX IDX_4034A3C0E747E99D ON transfer (from_club_id)');
        $this->addSql('CREATE INDEX IDX_4034A3C0EF8137C7 ON transfer (to_club_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transfer DROP FOREIGN KEY FK_4034A3C0E747E99D');
        $this->addSql('ALTER TABLE transfer DROP FOREIGN KEY FK_4034A3C0EF8137C7');
        $this->addSql('DROP INDEX IDX_4034A3C0E747E99D ON transfer');
        $this->addSql('DROP INDEX IDX_4034A3C0EF8137C7 ON transfer');
        $this->addSql('ALTER TABLE transfer DROP from_club_id, DROP to_club_id');
    }
}
