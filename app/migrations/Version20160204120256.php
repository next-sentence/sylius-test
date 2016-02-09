<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160204120256 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sylius_product_archetype_attribute_widget (id INT AUTO_INCREMENT NOT NULL, archetype_id INT DEFAULT NULL, attribute_id INT DEFAULT NULL, backend_widget VARCHAR(32) NOT NULL, frontend_widget VARCHAR(32) NOT NULL, INDEX IDX_7BB52472732C6CC7 (archetype_id), INDEX IDX_7BB52472B6E62EFA (attribute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sylius_product_archetype_attribute_widget ADD CONSTRAINT FK_7BB52472732C6CC7 FOREIGN KEY (archetype_id) REFERENCES sylius_product_archetype (id)');
        $this->addSql('ALTER TABLE sylius_product_archetype_attribute_widget ADD CONSTRAINT FK_7BB52472B6E62EFA FOREIGN KEY (attribute_id) REFERENCES sylius_product_attribute (id)');
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

        $this->addSql('DROP TABLE sylius_product_archetype_attribute_widget');
        $this->addSql('DROP INDEX fulltext_search_idx ON sylius_search_index');
        $this->addSql('CREATE FULLTEXT INDEX fulltext_search_idx ON sylius_search_index (value)');
    }
}
