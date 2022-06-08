function delete_confirm()
{
			if(confirm("Voulez vous vraiment supprimer cette facture ?"))
			{
				alert('Supression effectuer');
				location.href= 'deleteFacture.php';
			}
			else
			{
				alert('Suppression annulée');
				location.href='listefactures.php';
			}
		}

		