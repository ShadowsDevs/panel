#!/bin/bash

echo "🚀 Սկսվում է Shadowdactyl-ի լրիվ (FULL) ռեբրենդինգը..."

# 1. ԳԻԹՀԱԲԻ ՀՂՈՒՄՆԵՐԻ ՓՈԽԱՐԻՆՈՒՄ (PANEL ԵՎ WINGS)
echo "🔗 Փոխարինվում են GitHub-ի բոլոր հղումները..."
find . -type f -not -path '*/.git/*' -exec sed -i 's|https://github.com/ShadowsDevs/panel|https://github.com/ShadowsDevs/panel|g' {} +
find . -type f -not -path '*/.git/*' -exec sed -i 's|https://github.com/ShadowsDevs/wings|https://github.com/ShadowsDevs/wings|g' {} +

# 2. ՓՈԽԱՐԻՆՈՒՄ ՖԱՅԼԵՐԻ ՆԵՐՍՈՒՄ (ՏԵՔՍՏԵՐ, ԿՈԴ, NAMESPACES)
echo "📝 Փոխարինվում են անվանումները ֆայլերի ներսում..."
find . -type f -not -path '*/.git/*' -exec sed -i 's/shadowdactyl/shadowdactyl/g' {} +
find . -type f -not -path '*/.git/*' -exec sed -i 's/Shadowdactyl/Shadowdactyl/g' {} +
find . -type f -not -path '*/.git/*' -exec sed -i 's/SHADOWDACTYL/SHADOWDACTYL/g' {} +

# 3. ՖԱՅԼԵՐԻ ԵՎ ԹՂԹԱՊԱՆԱԿՆԵՐԻ (FOLDERS) ԱՆՎԱՆԱՓՈԽՈՒՄ (Խորքից դեպի վերև)
echo "📁 Անվանափոխվում են ֆայլերն ու թղթապանակները..."

# Փոքրատառ shadowdactyl -> shadowdactyl
find . -depth -name "*shadowdactyl*" -not -path '*/.git/*' -exec bash -c '
  for item; do
    dir=$(dirname "$item")
    base=$(basename "$item")
    new_base="${base//shadowdactyl/shadowdactyl}"
    mv "$item" "$dir/$new_base"
  done
' _ {} +

# Մեծատառ Shadowdactyl -> Shadowdactyl
find . -depth -name "*Shadowdactyl*" -not -path '*/.git/*' -exec bash -c '
  for item; do
    dir=$(dirname "$item")
    base=$(basename "$item")
    new_base="${base//Shadowdactyl/Shadowdactyl}"
    mv "$item" "$dir/$new_base"
  done
' _ {} +

# Ամբողջությամբ մեծատառ SHADOWDACTYL -> SHADOWDACTYL
find . -depth -name "*SHADOWDACTYL*" -not -path '*/.git/*' -exec bash -c '
  for item; do
    dir=$(dirname "$item")
    base=$(basename "$item")
    new_base="${base//SHADOWDACTYL/SHADOWDACTYL}"
    mv "$item" "$dir/$new_base"
  done
' _ {} +

# 4. COMPOSER-Ի ԹԱՐՄԱՑՈՒՄ ( PHP Autoloader-ի համար )
echo "⚙️ Թարմացվում է PHP Autoloader-ը..."
composer dump-autoload

echo "✅ FULL ռեբրենդինգը հաջողությամբ ավարտվեց:"
