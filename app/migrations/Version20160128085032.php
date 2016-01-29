<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160128085032 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sylius_taxon ADD productArchetype_id INT DEFAULT NULL, ADD serviceArchetype_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_taxon ADD CONSTRAINT FK_CFD811CA998F9BDE FOREIGN KEY (productArchetype_id) REFERENCES sylius_product_archetype (id)');
        $this->addSql('ALTER TABLE sylius_taxon ADD CONSTRAINT FK_CFD811CAF93A236D FOREIGN KEY (serviceArchetype_id) REFERENCES sylius_product_archetype (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFD811CA998F9BDE ON sylius_taxon (productArchetype_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFD811CAF93A236D ON sylius_taxon (serviceArchetype_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sylius_taxon DROP FOREIGN KEY FK_CFD811CA998F9BDE');
        $this->addSql('ALTER TABLE sylius_taxon DROP FOREIGN KEY FK_CFD811CAF93A236D');
        $this->addSql('DROP INDEX UNIQ_CFD811CA998F9BDE ON sylius_taxon');
        $this->addSql('DROP INDEX UNIQ_CFD811CAF93A236D ON sylius_taxon');
        $this->addSql('ALTER TABLE sylius_taxon DROP productArchetype_id, DROP serviceArchetype_id');
    }
}
