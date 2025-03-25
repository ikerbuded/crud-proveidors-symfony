<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250325190136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5C16D776E7927C74 ON proveidor (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5C16D776897DA477 ON proveidor (telefon)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_5C16D776E7927C74 ON proveidor');
        $this->addSql('DROP INDEX UNIQ_5C16D776897DA477 ON proveidor');
    }
}
