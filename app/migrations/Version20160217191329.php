<?php

namespace Fyb\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160217191329 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sylius_taxon DROP FOREIGN KEY FK_CFD811CAF93A236D');
        $this->addSql('ALTER TABLE sylius_taxon DROP FOREIGN KEY FK_CFD811CA998F9BDE');
        $this->addSql('DROP INDEX UNIQ_CFD811CA998F9BDE ON sylius_taxon');
        $this->addSql('DROP INDEX UNIQ_CFD811CAF93A236D ON sylius_taxon');
        $this->addSql('ALTER TABLE sylius_taxon ADD product_archetype_id INT DEFAULT NULL, ADD service_archetype_id INT DEFAULT NULL, DROP productArchetype_id, DROP serviceArchetype_id');
        $this->addSql('ALTER TABLE sylius_taxon ADD CONSTRAINT FK_CFD811CAFE884EAC FOREIGN KEY (product_archetype_id) REFERENCES sylius_product_archetype (id)');
        $this->addSql('ALTER TABLE sylius_taxon ADD CONSTRAINT FK_CFD811CAAC801922 FOREIGN KEY (service_archetype_id) REFERENCES sylius_product_archetype (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFD811CAFE884EAC ON sylius_taxon (product_archetype_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFD811CAAC801922 ON sylius_taxon (service_archetype_id)');
        $this->addSql('DROP INDEX fulltext_search_idx ON sylius_search_index');
        $this->addSql('CREATE INDEX fulltext_search_idx ON sylius_search_index (item_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX fulltext_search_idx ON sylius_search_index');
        $this->addSql('CREATE FULLTEXT INDEX fulltext_search_idx ON sylius_search_index (value)');
        $this->addSql('ALTER TABLE sylius_taxon DROP FOREIGN KEY FK_CFD811CAFE884EAC');
        $this->addSql('ALTER TABLE sylius_taxon DROP FOREIGN KEY FK_CFD811CAAC801922');
        $this->addSql('DROP INDEX UNIQ_CFD811CAFE884EAC ON sylius_taxon');
        $this->addSql('DROP INDEX UNIQ_CFD811CAAC801922 ON sylius_taxon');
        $this->addSql('ALTER TABLE sylius_taxon ADD productArchetype_id INT DEFAULT NULL, ADD serviceArchetype_id INT DEFAULT NULL, DROP product_archetype_id, DROP service_archetype_id');
        $this->addSql('ALTER TABLE sylius_taxon ADD CONSTRAINT FK_CFD811CAF93A236D FOREIGN KEY (serviceArchetype_id) REFERENCES sylius_product_archetype (id)');
        $this->addSql('ALTER TABLE sylius_taxon ADD CONSTRAINT FK_CFD811CA998F9BDE FOREIGN KEY (productArchetype_id) REFERENCES sylius_product_archetype (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFD811CA998F9BDE ON sylius_taxon (productArchetype_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFD811CAF93A236D ON sylius_taxon (serviceArchetype_id)');
    }
}
