for i in *.json -maxdepth 1; do
	topojson -o topo/$i $i -p
done