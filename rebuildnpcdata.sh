sudo rm NPCData/src/Model/Behavior/*.php
sudo rm NPCData/src/Model/Entity/*.php
sudo rm NPCData/src/Model/Table/*.php
sudo rm -rf NPCData/tests
sudo ../../bin/cake bake model all -c npcdata -p Vorien/NPCData
sudo ../../bin/cake bake controller all -c npcdata -p Vorien/NPCData
sudo ../../bin/cake bake template all -c npcdata -p Vorien/NPCData
sudo chown -R mcoury:www-data NPCData
sudo chmod -R 777 NPCData



