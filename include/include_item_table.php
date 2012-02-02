<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: include_item_table.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

		define('TYPE_ITEM',      3);
		define('TYPE_CONTAINER', 7);
		
		define('ITEM_FIELD_GUID',                 0x0000);
		define('ITEM_FIELD_TYPE',                 0x0002);
		define('ITEM_FIELD_ENTRY',                0x0003);
		define('ITEM_FIELD_SCALE_X',              0x0004);
		define('ITEM_FIELD_PADDING',              0x0005);
		define('ITEM_FIELD_OWNER',                0x0006);     // 2 4 1
		define('ITEM_FIELD_CONTAINED',            0x0008);     // 2 4 1
		define('ITEM_FIELD_CREATOR',              0x000A);     // 2 4 1
		define('ITEM_FIELD_GIFTCREATOR',          0x000C);     // 2 4 1
		define('ITEM_FIELD_STACK_COUNT',          0x000E);     // 1 1 20
		define('ITEM_FIELD_DURATION',             0x000F);     // 1 1 20
		define('ITEM_FIELD_SPELL_CHARGES',        0x0010);     // 5 1 20
		define('ITEM_FIELD_FLAGS',                0x0015);     // 1 1 1
		define('ITEM_FIELD_ENCHANTMENT',          0x0016);     // 33 1 1
		define('PERM_ENCHANTMENT_SLOT',   ITEM_FIELD_ENCHANTMENT);
		define('TEMP_ENCHANTMENT_SLOT',   ITEM_FIELD_ENCHANTMENT+3);
		define('SOCK_ENCHANTMENT_SLOT',   ITEM_FIELD_ENCHANTMENT+6);
		define('SOCK_ENCHANTMENT_SLOT_2', ITEM_FIELD_ENCHANTMENT+9);
		define('SOCK_ENCHANTMENT_SLOT_3', ITEM_FIELD_ENCHANTMENT+12);
		define('BONUS_ENCHANTMENT_SLOT',  ITEM_FIELD_ENCHANTMENT+15);
		define('WOTLK_ENCHANTMENT_SLOT',  ITEM_FIELD_ENCHANTMENT+18);
		define('PROP_ENCHANTMENT_SLOT_0', ITEM_FIELD_ENCHANTMENT+21); // used with RandomSuffix
		define('PROP_ENCHANTMENT_SLOT_1', ITEM_FIELD_ENCHANTMENT+24); // used with RandomSuffix
		define('PROP_ENCHANTMENT_SLOT_2', ITEM_FIELD_ENCHANTMENT+27); // used with RandomSuffix and RandomProperty
		define('PROP_ENCHANTMENT_SLOT_3', ITEM_FIELD_ENCHANTMENT+30); // used with RandomProperty
		define('PROP_ENCHANTMENT_SLOT_4', ITEM_FIELD_ENCHANTMENT+33); // used with RandomProperty
		define('ITEM_FIELD_PROPERTY_SEED',        0x003A);     // 1 1 1
		define('ITEM_FIELD_SUFFIX_FACTOR', ITEM_FIELD_PROPERTY_SEED);
		define('ITEM_FIELD_RANDOM_PROPERTIES_ID', 0x003B);     // 1 1 1
		define('ITEM_FIELD_ITEM_TEXT_ID',         0x003C);     // 1 1 4
		define('ITEM_FIELD_DURABILITY',           0x003D);     // 1 1 20
		define('ITEM_FIELD_MAXDURABILITY',        0x003E);     // 1 1 20
		define('ITEM_FIELD_PAD',                  0x003F);
		define('ITEM_END',                        0x0040);
		
		define('CONTAINER_FIELD_NUM_SLOTS',       ITEM_END + 0x0000); // Size: 1, Type: INT, Flags: PUBLIC
		define('CONTAINER_ALIGN_PAD',             ITEM_END + 0x0001); // Size: 1, Type: BYTES, Flags: NONE
		define('CONTAINER_FIELD_SLOT_1',          ITEM_END + 0x0002); // Size: 72, Type: LONG, Flags: PUBLIC
		define('CONTAINER_END',                   ITEM_END + 0x004A);
		
		// Флаги поля ITEM_FIELD_FLAGS
		define('ITEM_FLAGS_BINDED',          0x00000001);
		define('ITEM_FLAGS_CONJURED',        0x00000002);
		define('ITEM_FLAGS_OPENABLE',        0x00000004);
		define('ITEM_FLAGS_HEROIC',          0x00000008);
		define('ITEM_FLAGS_WRAPPER',         0x00000200); // used or not used wrapper
		define('ITEM_FLAGS_PARTY_LOOT',      0x00000800); // determines if item is party loot or not
		define('ITEM_FLAGS_CHARTER',         0x00002000); // arena/guild charter
		define('ITEM_FLAGS_PROSPECTABLE',    0x00040000);
		define('ITEM_FLAGS_UNIQUE_EQUIPPED', 0x00080000);
		define('ITEM_FLAGS_USEABLE_IN_ARENA',0x00200000);
		define('ITEM_FLAGS_THROWABLE',       0x00400000); // not used in game for check trow possibility, only for item in game tooltip
		define('ITEM_FLAGS_SPECIALUSE',      0x00800000); //
		define('ITEM_FLAGS_BOA',             0x08000000); // bind on account
		define('ITEM_FLAGS_ENCHANTER_SCROLL',0x10000000);
		define('ITEM_FLAGS_MILLABLE',        0x20000000);
		define('ITEM_FLAGS_BOP_TRADEABLE',   0x80000000);
		
		// Флаги поля ITEM_FIELD_FLAGS2
		define('ITEM_FLAGS2_HORDE_ONLY',             0x00000001);
		define('ITEM_FLAGS2_ALLIANCE_ONLY',          0x00000002);
		define('ITEM_FLAGS2_EXT_COST_REQUIRES_GOLD', 0x00000004);
		define('ITEM_FLAGS2_NEED_ROLL_DISABLED',     0x00000100);
		
		// Флаги BAG_FAMILY_MASK
		define('BAG_FAMILY_MASK_ARROWS',     0x00000001);
		define('BAG_FAMILY_MASK_BULLETS',    0x00000002);
		define('BAG_FAMILY_MASK_SHARDS',     0x00000004);
		define('BAG_FAMILY_MASK_LEATHERWORKING_SUPP', 0x00000008);
		define('BAG_FAMILY_MASK_INSCRIPTION_SUPP',     0x00000010);
		define('BAG_FAMILY_MASK_HERBS',      0x00000020);
		define('BAG_FAMILY_MASK_ENCHANTING_SUPP', 0x00000040);
		define('BAG_FAMILY_MASK_ENGINEERING_SUPP', 0x00000080);
		define('BAG_FAMILY_MASK_KEYS',       0x00000100);
		define('BAG_FAMILY_MASK_GEMS',       0x00000200);
		define('BAG_FAMILY_MASK_MINING_SUPP',0x00000400);
		define('BAG_FAMILY_MASK_SOULBOUND_EQUIPMENT', 0x00000800);
		define('BAG_FAMILY_MASK_VANITY_PETS',0x00001000);
		define('BAG_FAMILY_MASK_CURRENCY_TOKENS', 0x00002000);
		define('BAG_FAMILY_MASK_QUEST_ITEMS', 0x00004000);
?>
