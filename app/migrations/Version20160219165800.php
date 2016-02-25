<?php

namespace Fyb\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160219165800 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fyb_store (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, address LONGTEXT DEFAULT NULL, enabled TINYINT(1) NOT NULL, geoloc LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_A2EB2EBF77153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sylius_product ADD store_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_product ADD CONSTRAINT FK_677B9B74B092A811 FOREIGN KEY (store_id) REFERENCES fyb_store (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_677B9B74B092A811 ON sylius_product (store_id)');
        $this->addSql('ALTER TABLE sylius_user ADD store_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_user ADD CONSTRAINT FK_569A33C0B092A811 FOREIGN KEY (store_id) REFERENCES fyb_store (id) ON DELETE SET NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_569A33C0B092A811 ON sylius_user (store_id)');
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

        $this->addSql('ALTER TABLE sylius_product DROP FOREIGN KEY FK_677B9B74B092A811');
        $this->addSql('ALTER TABLE sylius_user DROP FOREIGN KEY FK_569A33C0B092A811');
        $this->addSql('DROP TABLE fyb_store');
        $this->addSql('DROP INDEX IDX_677B9B74B092A811 ON sylius_product');
        $this->addSql('ALTER TABLE sylius_product DROP store_id');
        $this->addSql('DROP INDEX fulltext_search_idx ON sylius_search_index');
        $this->addSql('CREATE FULLTEXT INDEX fulltext_search_idx ON sylius_search_index (value)');
        $this->addSql('DROP INDEX UNIQ_569A33C0B092A811 ON sylius_user');
        $this->addSql('ALTER TABLE sylius_user DROP store_id');
    }
}
