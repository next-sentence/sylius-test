<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160121142935 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sylius_product_attribute ADD requirement VARCHAR(255) NOT NULL, ADD filter VARCHAR(255) NOT NULL');
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

        $this->addSql('ALTER TABLE sylius_product_attribute DROP requirement, DROP filter');
        $this->addSql('DROP INDEX fulltext_search_idx ON sylius_search_index');
        $this->addSql('CREATE FULLTEXT INDEX fulltext_search_idx ON sylius_search_index (value)');
    }
}
