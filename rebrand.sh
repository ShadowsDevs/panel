#!/bin/bash

echo "🚀 Սկսվում է Shadowdactyl-ի լրիվ (FULL) ռեբրենդինգը..."

# 1. ԳԻԹՀԱԲԻ ՀՂՈՒՄՆԵՐԻ ՓՈԽԱՐԻՆՈՒՄ (PANEL ԵՎ WINGS)
echo "🔗 Փոխարինվում են GitHub-ի բոլոր հղումները..."
find . -type f -not -path '*/.git/*' -exec sed -i 's|https://github.com/pterodactyl/panel|https://github.com/ShadowsDevs/panel|g' {} +
find . -type f -not -path '*/.git/*' -exec sed -i 's|https://github.com/pterodactyl/wings|https://github.com/ShadowsDevs/wings|g' {} +

# 2. ՓՈԽԱՐԻՆՈՒՄ ՖԱՅԼԵՐԻ ՆԵՐՍՈՒՄ (ՏԵՔՍՏԵՐ, ԿՈԴ, NAMESPACES)
echo "📝 Փոխարինվում են անվանումները ֆայլերի ներսում..."
find . -type f -not -path '*/.git/*' -exec sed -i 's/pterodactyl/shadowdactyl/g' {} +
find . -type f -not -path '*/.git/*' -exec sed -i 's/Pterodactyl/Shadowdactyl/g' {} +
find . -type f -not -path '*/.git/*' -exec sed -i 's/PTERODACTYL/SHADOWDACTYL/g' {} +

# 3. ՖԱՅԼԵՐԻ ԵՎ ԹՂԹԱՊԱՆԱԿՆԵՐԻ (FOLDERS) ԱՆՎԱՆԱՓՈԽՈՒՄ (Խորքից դեպի վերև)
echo "📁 Անվանափոխվում են ֆայլերն ու թղթապանակները..."

# Փոքրատառ pterodactyl -> shadowdactyl
find . -depth -name "*pterodactyl*" -not -path '*/.git/*' -exec bash -c '
  for item; do
    dir=$(dirname "$item")
    base=$(basename "$item")
    new_base="${base//pterodactyl/shadowdactyl}"
    mv "$item" "$dir/$new_base"
  done
' _ {} +

# Մեծատառ Pterodactyl -> Shadowdactyl
find . -depth -name "*Pterodactyl*" -not -path '*/.git/*' -exec bash -c '
  for item; do
    dir=$(dirname "$item")
    base=$(basename "$item")
    new_base="${base//Pterodactyl/Shadowdactyl}"
    mv "$item" "$dir/$new_base"
  done
' _ {} +

# Ամբողջությամբ մեծատառ PTERODACTYL -> SHADOWDACTYL
find . -depth -name "*PTERODACTYL*" -not -path '*/.git/*' -exec bash -c '
  for item; do
    dir=$(dirname "$item")
    base=$(basename "$item")
    new_base="${base//PTERODACTYL/SHADOWDACTYL}"
    mv "$item" "$dir/$new_base"
  done
' _ {} +

# 4. COMPOSER-Ի ԹԱՐՄԱՑՈՒՄ ( PHP Autoloader-ի համար )
echo "⚙️ Թարմացվում է PHP Autoloader-ը..."
composer dump-autoload

echo "✅ FULL ռեբրենդինգը հաջողությամբ ավարտվեց:"
